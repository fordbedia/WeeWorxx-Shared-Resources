<?php


namespace WeeWorxxSDK\SharedResources\Modules\User\OAuth;

use http\Exception\RuntimeException;
use WeeWorxxSDK\SharedResources\Modules\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use WeeWorxxSDK\SharedResources\Modules\User\Concerns\OAuthToken;

class UserOAuth extends OAuthToken implements OAuthContract
{
    /**
     * @var Request
     */
    public Request $request;

    /**
     * @var string
     */
    const PROVIDER = 'User';

    /**
     * @var object
     */
    public object $userObject;

    /**
     * @constant string uri
     */
    const OATH_URI = '/oauth/token';

    /**
     * OauthTokenResponse constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->userObject = new UserOAuthObjectValidation(self::PROVIDER, $this->request);
    }

    /**
     * @return mixed
     */
    public function createToken(): array
    {
        $user = $this->userObject->getUserObject();

        if (! $user) {
            throw new \RuntimeException('Cannot generate token. Please check auth credential');
        }

        $uri = config('app.url') . self::OATH_URI;

        return $this->create($user, $uri, $this->request);
    }

    /**
     * Map provider
     * @param Request $request
     */
    public function addCredentials(Request $request): void
    {
        $request->request->add([
            'grant_type'    => 'password',
            'username' => $request->username,
            'password' => $request->password,
            'client_id'     => config('passport.user_access_client.client_id'),
            'client_secret' => config('passport.user_access_client.client_secret'),
            'scope' => '*'
        ]);
    }
}
