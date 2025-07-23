<?php

namespace WeeWorxxSDK\SharedResources\Modules\User\OAuth;

use Illuminate\Http\Request;

interface OAuthContract
{
    public function createToken(): array;

    public function addCredentials(Request $request): void;
}
