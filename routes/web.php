<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', function () {
    return redirect()->route('pasien.index');
});

// disable route '/register'
Route::match(["GET", "POST"], "/register", function(){
    return redirect("/login");
})->name("register");

Route::resource('pasien', 'Pasien\PasienController');
Route::resource('user', 'User\UserController');

Route::group(['prefix' => 'pasien/detail/{id}'], function () {
    Route::get('/', 'Pasien\PasienDetailController@index')->name('detail.index');
    Route::get('create', 'Pasien\PasienDetailController@create')->name('detail.create');
    Route::post('/', 'Pasien\PasienDetailController@store')->name('detail.store');
    Route::get('{detail_id}/edit', 'Pasien\PasienDetailController@edit')->name('detail.edit');
    Route::put('{detail_id}', 'Pasien\PasienDetailController@update')->name('detail.update');
    Route::delete('{detail_id}', 'Pasien\PasienDetailController@destroy')->name('detail.destroy');
});

Route::group(['prefix' => 'getdata'], function () {
    Route::get('pasien', 'DataTableController@getPasien')->name('getdata.pasien');
});