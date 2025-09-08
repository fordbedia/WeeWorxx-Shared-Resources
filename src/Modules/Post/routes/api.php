<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use WeeWorxxSDK\SharedResources\Modules\Post\Http\Controllers\PostsController;
use WeeWorxxSDK\SharedResources\Modules\Post\Http\Controllers\PostSearchController;

Route::group([
    'prefix'    => 'v1',
    'middleware' => 'api'
], function () {
		Route::get('/posts/search', [PostSearchController::class, 'search'])->middleware('auth.optional:api');;
    Route::resource('posts', PostsController::class);
});
