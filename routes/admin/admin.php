<?php

use App\Admin\Setting;

Route::get('/closed/website', function (Setting $setting) {
    $setting = Setting::find(1);
    if ($setting->status == 'pending') {
        return view('closed');
    }else{
        return redirect()->route('home_page');
    }
})->name('closed_website');

Route::group(['prefix'=>'admin'],function (){
    Route::get('/','AdminController@admin_index')->name('admin.index');
    Route::get('/login','AdminController@admin_get')->name('admin_get');
    Route::post('/login','AdminController@admin_post')->name('admin_post');
    Route::group(['middleware'=>'admin:admin'],function (){
        // Admins Routes
        Route::resource('admins','AdminsController');
        Route::get('delete/all/admins','AdminsController@delete_all')->name('delete_all_admins');
        Route::get('/logout','AdminController@admin_logout')->name('admin_logout');
        Route::get('/profile','AdminController@admin_profile_get')->name('profile_get');
        Route::post('/profile','AdminController@admin_profile_post')->name('profile_post');

        // Users Routes
        Route::resource('users','UsersController');
        Route::get('delete/all/users','UsersController@delete_all')->name('delete_all_users');

        // Countries Routes
        Route::resource('countries','CountriesController');
        Route::get('delete/all/countries','CountriesController@delete_all')->name('delete_all_countries');

        // Category Routes
        Route::resource('categories','CategoriesController');
        Route::get('delete/all/categories','CategoriesController@delete_all')->name('delete_all_categories');

        // Ad Routes
        Route::resource('ads','AdsController');
        Route::get('delete/all/ads','AdsController@delete_all')->name('delete_all_ads');
        Route::get('change/status/{id}','AdsController@change_status')->name('change_status');

        // News Routes
        Route::resource('news','NewsController');
        Route::get('change/status/news/{id}','NewsController@change_status')->name('change_status_news');
        Route::get('delete/all/news','NewsController@delete_all')->name('delete_all_news');

        // Setting Route
        Route::get('settings','SettingsController@setting')->name('setting');
        Route::post('settings','SettingsController@settings')->name('settings');

    });
    Route::get('lang/{lang}',function ($lang){
        session()->has('lang') ? session()->forget('lang') : '';
        session()->put('lang',$lang);
        return back();
    })->name('admin_lang');

    Route::get('/debug',function (){
        return view('includes._debug');
    });

});
