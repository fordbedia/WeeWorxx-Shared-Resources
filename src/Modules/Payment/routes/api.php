<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use WeeWorxxSDK\SharedResources\Modules\Payment\Http\Controllers\StripeController;

Route::group([
    'prefix'    => 'v1',
    'middleware' => 'api'
], function () {
    Route::group(['prefix' => '/', 'middleware' => 'auth:api'], function() {
        Route::post('payments/create-intent', [StripeController::class, 'createPaymentIntent']);
        Route::get('payments/methods', [StripeController::class, 'listPaymentMethods']);
        Route::post('payments/charge-saved', [StripeController::class, 'payWithSavedCard']);
        Route::post('payments/remove-payment-method', [StripeController::class, 'removePaymentMethod']);
    });
});
