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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test', function () {
    echo "自定义";
});
Route::get('spider/index', 'SpiderController@index');
Route::get('qiniu/index', 'QiniuController@index');
Route::group(['middleware' => ['CheckToken']], function () {
    Route::get('token', function () {
        echo "token";
    });
    Route::get('index/show', 'IndexController@show');
});
