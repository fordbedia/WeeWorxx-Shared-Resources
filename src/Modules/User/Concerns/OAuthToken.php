<?php

namespace WeeWorxxSDK\SharedResources\Modules\User\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

abstract class OAuthToken
{
    /**
     * @param Model|null $user
     * @param string $uri
     * @param Request $request
     * @return array
     */
    public function create(Model|null $user, string $uri, Request $request): array
    {
        // Add all request data into the request
        $this->addCredentials($request);

        // Ensure that the data added to $request is correctly carried over. Pass the $request->all() added by $this->addCredentials($request);
        $tokenRequest = Request::create($uri, 'post', $request->all());

        // Dispatch the route
        $token = Route::dispatch($tokenRequest);

        // Pass the authenticated user data
        $response = collect($user);

        // Include the token into the collection
        $response->put('token', json_decode($token->getContent()));

        return $response->toArray();
    }

    /**
     * @param Request $request
     * @return void
     */
    abstract public function addCredentials(Request $request): void;
}
