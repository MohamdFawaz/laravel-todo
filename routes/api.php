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

// Task routes...
Route::group(['prefix' => 'task', 'namespace' => 'api'],function (){
    Route::get('/{completed}', 'TaskController@index');
    Route::post('/', 'TaskController@store');
    Route::put('/{id}', 'TaskController@update');
    Route::put('/toggle-completed/{id}', 'TaskController@toggleCompleted');
    Route::delete('/{id}', 'TaskController@destroy');
});
