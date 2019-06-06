<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api_admin')->get('/admin', function (Request $request) {
    return $request->auth()->guard('admin')->user();
});
Route::get('/admin?token={token}','AdminController@admin_post');
Route::group(['middleware'=>'api_admin:admin'],function (){

    Route::resource('admins','AdminsController');

});
