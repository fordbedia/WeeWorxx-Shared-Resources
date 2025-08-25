<?php

namespace WeeWorxxSDK\SharedResources\Modules\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
				$data = $request->validate([
					'amount'         => 'required|integer|min:1', // cents
					'currency'       => 'sometimes|string|size:3',
					'save_for_later' => 'sometimes|boolean',
			]);

        Stripe::setApiKey(config('services.stripe.secret'));
        // 1️⃣ Create or retrieve Customer
        $user = $request->user(); // assume auth
				if (!$user->stripe_customer_id) {
					$customer = $user->stripe_customer_id ?? Customer::create(['email' => $user->email]);
					$user->stripe_customer_id = $customer->id;
					$user->save();
				}
				$customerId = $user->stripe_customer_id;

				$params = [
					'amount'            => $request->amount,      // cents
					'currency'          => $data['currency'],
					'customer'          => $customerId,
					// 'setup_future_usage'=> 'off_session',
					'automatic_payment_methods' => ['enabled' => true],
				];

				// Only attach/save the card if user opted in
				if (!empty($data['save_for_later'])) {
						$params['setup_future_usage'] = 'off_session';
				}

        // Create a PaymentIntent that will vault the card
        $intent = PaymentIntent::create($params);

        return response()->json([
            'clientSecret' => $intent->client_secret,
            'customerId'   => $customerId,
        ]);
    }

    public function listPaymentMethods(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $customerId = $request->user()->stripe_customer_id;

        $methods = PaymentMethod::all([
            'customer' => $customerId,
            'type'     => 'card',
        ]);

        return response()->json($methods->data);
    }

    public function payWithSavedCard(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $intent = PaymentIntent::create([
            'amount'         => $request->amount,
            'currency'       => 'usd',
            'customer'       => $request->customerId,
            'payment_method' => $request->paymentMethodId,
            'off_session'    => true,
            'confirm'        => true,
        ]);

        return response()->json([
            'status' => $intent->status,
            'paymentIntent'  => [
              'id'            => $intent->id,
              'client_secret' => $intent->client_secret,
            ],
        ]);
    }

    public function removePaymentMethod(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $pmId = $request->input('paymentMethodId');

        $paymentMethod = PaymentMethod::retrieve($pmId);

        // Detach it from Stripe
        $detached = $paymentMethod->detach();

        return response()->json([
            'success' => true,
            'detached' => $detached->id,
        ]);
    }
}
