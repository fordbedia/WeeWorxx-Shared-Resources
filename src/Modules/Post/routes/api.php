<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use WeeWorxxSDK\SharedResources\Modules\Post\Http\Controllers\PostsController;

Route::group([
    'prefix'    => 'v1',
    'middleware' => 'api'
], function () {
    Route::resource('posts', PostsController::class);
});
