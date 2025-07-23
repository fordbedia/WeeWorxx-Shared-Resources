<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use WeeWorxxSDK\SharedResources\Modules\User\Http\Controllers\UserController;

Route::group([
    'prefix'    => 'v1',
    'middleware' => 'api'
], function () {
    Route::resource('users', UserController::class);
    Route::post('users/authenticate', [UserController::class, 'authenticate']);
    Route::group(['prefix' => '/', 'middleware' => 'auth:api'], function() {

    });
});
