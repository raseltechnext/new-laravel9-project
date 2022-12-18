<?php

use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeUnit\FunctionUnit;

Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'is_admin'], function () {
  Route::get('/admin/home', 'AdminController@admin')->name('admin.home');
  Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');

  // Category Routes
  Route::group(['prefix' => 'category'], function () {
    Route::get('/', 'CategoryController@index')->name('category.index');
    Route::post('/store', 'CategoryController@store')->name('category.store');
    Route::get('/delete/{id}', 'CategoryController@delete')->name('category.delete');
    Route::get('/edit/{id}', 'CategoryController@edit');
    Route::post('/update', 'CategoryController@update')->name('category.update');
  });
});
