<?php

namespace App\Http\Controllers\ApiAuth;

use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends ApiController
{
    public $authController;

    public function __construct(AuthController $authController)
    {
        $this->authController = $authController;
    }

    public function redirect($provider): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function callback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();

        return redirect("http://localhost:8080/admin/login/social?token=$user->token&provider=$provider");
    }

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'token' => 'required'
        ]);

        $token = $request->input('token');
        $provider = $request->input('provider');

        $social_user = Socialite::driver($provider)->userFromToken($token);

        $user = $this->checkExitUser($provider, $social_user);

        if (!$user) {
            $user = User::create([
                'provider_id' => $social_user->id,
                'provider' => $provider,
                'name' => $social_user->name ?? $social_user->nickname,
                'email' => $social_user->email,
                'address' => $social_user->location ?? '',
                'image' => $social_user->avatar ?? '',
            ]);
        }

        $token = $this->authController->guard()->tokenById($user->id);

        return $this->authController->respondWithToken($token);
    }

    public function checkExitUser($provider, $social_user)
    {
        $email = $social_user->getEmail();
        $provider_id = $social_user->id;

        return $email ? User::where('email', $email)->first()
            : User::where('provider_id', $provider_id)
                ->where('provider', $provider)
                ->first();
    }
}
