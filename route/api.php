<?php
/**
 * Create by PhpStorm
 * Author     : chenz
 * Date       : 2020/1/11 10:26
 * description:
 */
use think\facade\Route;
Route::group('api/:version', function () {

    Route::group('/user', function () {
        Route::get('/index', 'api/:version.user/index'); // 课程首页


    });



})->header('Access-Control-Max-Age', 86400)
    ->header('Access-Control-Allow-Headers', '*')
    ->allowCrossDomain();
