<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Socialite;

class Auth2Controller extends Controller
{
    // get login form
    function login(Request $request)
    {
        return view("welcome");
    }

    // redirection
    function redirect(Request $request, $oauth)
    {
        Log::info("Github redirection ....");
        return Socialite::driver($oauth)->redirect();
    }

    // oauth
    function callback(Request $request, $oauth)
    {
        Log::info("Github authentication ....");
        // return Socialite::driver($oauth)->user();
        $OAuthUser = Socialite::driver($oauth)->stateless()->user();

        Log::debug("The OAuth user :", ["data" => $OAuthUser]);

        $user = User::updateOrCreate([
            'email' => $OAuthUser->email,
            'provider' => $oauth,
        ], [
            'name' => $OAuthUser->name ?? $OAuthUser->nickname,
            'email' => $OAuthUser->email,
            'password' => time(),

            // github
            'provider_id' => $OAuthUser->id,
            'provider_token' => $OAuthUser->token,
            'provider_refresh_token' => $OAuthUser->refreshToken,

            // google
        ]);

        Auth::login($user);

        return redirect("/")->with("success", "Vous êtes connecté.e avec succès!");
    }
}
