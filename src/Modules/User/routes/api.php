<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use WeeWorxxSDK\SharedResources\Modules\User\Http\Controllers\BookmarkController;
use WeeWorxxSDK\SharedResources\Modules\User\Http\Controllers\SocialController;
use WeeWorxxSDK\SharedResources\Modules\User\Http\Controllers\UserController;

Route::group([
    'prefix'    => 'v1',
        'middleware' => 'api'
], function () {
    Route::get('/auth/{provider}/redirect', [SocialController::class, 'redirect']);
    Route::get('/auth/{provider}/callback', [SocialController::class, 'callback'], []);
    Route::post('users/authenticate', [UserController::class, 'authenticate']);
    Route::group(['prefix' => '/', 'middleware' => 'auth:api'], function() {
        Route::get('users/verify-by-token', [UserController::class, 'verifyByToken']);
        Route::resource('bookmark', BookmarkController::class);
    });
    Route::resource('users', UserController::class);
});
