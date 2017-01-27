<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// -- Truck routes
Route::group(array('prefix' => '/partner'), function()
{
	Route::get('/getAll', 'Partner@getAll');
	Route::post('/getAll', 'Partner@getAll');
	Route::post('/create', 'Partner@create');
	Route::post('/delete', 'Partner@delete');
	Route::post('/edit', 'Partner@edit');
});


