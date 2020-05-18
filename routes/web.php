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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    
    //calendar
    Route::get('/', 'CalendarController@index');
    Route::get('/calendar', 'CalendarController@index');
    
    
    //category
    Route::get('/category', 'CategoryController@index')->name('category.index');
    
    Route::get('/category/create', 'CategoryController@showCreateForm');
    Route::post('/category/create', 'CategoryController@create');
    
    Route::group(['middleware' => 'can:view,category'], function() {

        Route::get('/category/{category}/edit', 'CategoryController@showEditForm')->name('category.edit');
        Route::post('/category/{category}/edit', 'CategoryController@edit');
        
        Route::post('/category/{category}/delete', 'CategoryController@delete')->name('category.delete');

    });


    //study
    Route::get('/study', 'StudyController@index');
    Route::post('/study/create', 'StudyController@create')->name('study.create');

    Route::post('/study/{study}/edit', 'StudyController@edit')->name('study.edit');

    Route::post('/study/{study}/delete', 'StudyController@delete')->name('study.delete');
    



});
