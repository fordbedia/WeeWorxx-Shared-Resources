<?php

namespace WeeWorxxSDK\SharedResources\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use WeeWorxxSDK\SharedResources\Modules\User\Models\User;

class SocialController extends Controller
{
    private array $allowed = ['google'];

    public function redirect(string $provider)
    {
        abort_unless(in_array($provider, $this->allowed, true), 404);

        $scopes = match ($provider) {
            'google'   => ['openid','profile','email'],
            'github'   => ['read:user','user:email'],
            'linkedin' => ['r_liteprofile','r_emailaddress'],
            default    => [],
        };

        if ($provider === 'google') {
             return Socialite::driver($provider)
                 ->scopes($scopes)
                 ->with(['prompt'=> 'login select_account', 'max_age' => 0])
                 ->stateless()
                 ->redirect();
        }

        return Socialite::driver($provider)
            ->scopes($scopes)
            ->stateless() // SPA-friendly
            ->redirect();
    }

    public function callback(string $provider)
    {
        abort_unless(in_array($provider, $this->allowed, true), 404);

        $social = Socialite::driver($provider)->stateless()->user();

        $user = User::query()
            ->where("{$provider}_id", $social->getId())
            ->first();

        if (! $user) {
            $user = User::query()->create([
                'name' => $social->getName(),
                'fname' => $social->getRaw()['given_name'] ?? '',
                'lname' => $social->getRaw()['family_name'] ?? '',
                'avatar' => $social->avatar ?? '',
                'email' => $social->getEmail(),
                'auth_type' => $provider,
                "{$provider}_id" => $social->getId(),
            ]);
        } else {
            $dirty = false;
            if (! $user->{"{$provider}_id"}) {
                $user->{"{$provider}_id"} = $social->getId();
                $dirty = true;
            }
            if ($social->getAvatar() && $user->avatar !== $social->getAvatar()) {
                $user->avatar = $social->getAvatar();
                $dirty = true;
            }
            if ($dirty) $user->save();
        }

        // ===== Issue API token (Passport) ===== //
        // ============================================================
        // Create token
        // ============================================================
        $token = $user->createToken($provider)->accessToken;

        $url = config('app.url')."/oauth/callback?token={$token}&id={$social->getId()}&provider={$provider}";
        return redirect()->to($url);
    }
}
