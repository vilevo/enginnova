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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('posts/search', "API\PostController@search");
Route::post('api-jobs/search', "API\FreelanceJobController@search");

Route::group(['middleware' => ['api_user']], function () {

    //Create an user on this server
    Route::post('users/sync', "API\UserController@create");


});
