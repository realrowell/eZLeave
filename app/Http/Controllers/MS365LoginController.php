<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class MS365LoginController extends Controller
{
    public function redirectToMicrosoft()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    public function handleMicrosoftCallback()
    {
        $microsoftUser = Socialite::driver('microsoft')->stateless()->user();
        $user = User::where('email', $microsoftUser->email)->first();
        if(!$user)
        {
            // $user = User::create(['name' => $googleUser->name, 'email' => $googleUser->email, 'password' => \Hash::make(rand(100000,999999))]);
            return redirect(route('index'))->with('error','You are not currently registered!');
        }

        Auth::login($user);
        Log::info('LOGIN NOTICE || Successful Login || Login with Microsoft365 || Username: '.auth()->user()->user_name.' | Email: '.auth()->user()->email);

        return redirect(RouteServiceProvider::HOME);
    }

}
