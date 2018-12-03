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

Route::get('/', function () {
    return redirect('/home');   // redirect เป็นการบังคับวิ่งเข้าหน้า web
});

Auth::routes();

// Route::get('/downloadPDF/{id}', 'PetController@downloadPDF');
Route::group(['middleware' => 'auth'], function()

  {
    route::resource('PetControl','PetController');

    route::resource('location','MasterMainController');

    route::resource('temperature','TempController');

    Route::post('import', 'TempController@contactImport')->name('contactImport');

    Route::get('/ExportPDF', 'TempController@ReportPDF');

    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('/{name}', 'HomeController@index')->name('index');

  });
