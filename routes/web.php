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



/*
|
| Api Route Endpoints
|
*/

Route::get('ej-feed', 'EJController@ejapi');

Route::get('sun-feed', 'SunController@sunapi');

Route::get('metro-feed', 'MetroController@metroapi');

Route::get('global-feed', 'GlobalController@globalapi');

Route::get('aptn-feed', 'AptnController@aptnapi');

Route::get('cbc-feed', 'CbcController@cbcapi');

Route::get('ctv-feed', 'CtvController@ctvapi');

Route::get('bookmarks-feed', 'BookmarkController@bookmarkapi');




/* 
|
|Publication routes
|`
*/

Route::get('edmonton-journal', 'EJController@index');

Route::post('edmonton-journal', 'EJController@insert');


Route::get('edmonton-sun', 'SunController@index');

Route::post('edmonton-sun', 'SunController@insert');


Route::get('cbc-edmonton', 'CbcController@index');

Route::post('cbc-edmonton', 'CbcController@insert');


Route::get('ctv-edmonton', 'CtvController@index');

Route::post('ctv-edmonton', 'CtvController@insert');


Route::get('global-edmonton', 'GlobalController@index');

Route::post('global-edmonton', 'GlobalController@insert');


Route::get('metro-edmonton', 'MetroController@index');

Route::post('metro-edmonton', 'MetroController@insert');


Route::get('aptn', 'AptnController@index');

Route::post('aptn', 'AptnController@insert');


Route::post('add-bookmark', 'BookmarkController@index');

//Route::post('clear-all', 'ClearAllController@delete');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
