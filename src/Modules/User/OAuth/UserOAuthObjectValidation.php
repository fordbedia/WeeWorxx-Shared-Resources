<?php

namespace WeeWorxxSDK\SharedResources\Modules\User\OAuth;

use KAYNAMZSDK\SharedResources\App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserOAuthObjectValidation
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @var Request
     */
    protected Request $request;

    /**
     * UserOAuthObjectValidation constructor.
     * @param $provider
     * @param $request
     */
    public function __construct($provider, $request)
    {
        $this->mapProviders($provider);
        $this->request = $request;
    }

    /**
     * @return Model|null
     */
    public function getUserObject(): ?Model
    {
        $username = $this->request->username;
        $user = $this->model->where('email', '=', $username)->first();

        if ($user && $this->validateHash($user->password)) {
            return $user;
        }
        return null;
    }

    /**
     * @param string $password
     * @return bool
     */
    protected function validateHash(string $password): bool
    {
        if (Hash::check($this->request->password, $password)) {
            return true;
        }
        return false;
    }

    /**
     * @param string $provider
     */
    protected function mapProviders(string $provider): void
    {
        if ($provider === 'User') {
            $name = "\\WeeWorxxSDK\\SharedResources\\Modules\\User\\Models\\" . $provider;
            $this->model = new $name;
        }
    }
}
