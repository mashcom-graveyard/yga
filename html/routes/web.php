<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth']], function () {


    Route::get('/', function () {
        return redirect('/member');
    });

    Route::post('/member/update/{id}','MemberController@update');
    Route::resource('/member', 'MemberController');


    Route::get('/home', 'HomeController@index')->name('home');

});

Route::get('/logout','Auth\LoginController@logout');
Auth::routes();


