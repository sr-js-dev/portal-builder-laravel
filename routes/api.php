<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('register', 'API\RegisterController@register');
    Route::post('login', 'API\RegisterController@login');
});
Route::middleware('auth:api')->group( function () {
    Route::get('getPages', 'API\PageController@indexAction');
    Route::post('addPage', 'API\PageController@createAction');
    Route::post('getPageById/{id}', 'API\PageController@getPageByIdAction');
    Route::post('updagePage', 'API\PageController@updatePageAction');
    Route::post('deletePage/{id}', 'API\PageController@deletePageAction');
});