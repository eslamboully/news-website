<?php
Route::get('/','GuestController@home_page')->name('home_page');
Route::get('/category/all/news/{category_name}','GuestController@category_page')->name('category_page');
Route::get('/category/news/{category_name}/{news_name}','GuestController@single_page')->name('single_page');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
