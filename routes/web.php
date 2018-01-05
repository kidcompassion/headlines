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
    return view('welcome');
});


//Route::get('/all-feeds', 'RssController@index');

Route::get('/bookmarks', function () {
    return view('bookmarked-items');
});

Route::get('/add-feeds', function () {
    return view('add-feeds');
});


Route::group(['prefix' => 'api/v1'], function(){

    Route::resource('all-feeds', 'RssController');
    
});



/* 
* Publication routes
*/

Route::get('/edmonton-journal', function () {
    return view('edmonton-journal');
});

Route::get('/edmonton-sun', function () {
    return view('edmonton-sun');
});

Route::get('/cbc', function () {
    return view('cbc');
});

Route::get('/global', function () {
    return view('global');
});

Route::get('/ctv', function () {
    return view('ctv');
});

Route::get('/aptn', function () {
    return view('aptn');
});