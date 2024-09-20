<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectgoogle(){
        return Socialite::driver('google')->redirect();
    }
    public function callbackgoogle(){
        $socialUser = Socialite::driver('google')->user();
        $registerUser=User::where('google_id',$socialUser->id)->first();
        if(!$registerUser){

           $user = User::updateOrCreate([
            'google_id' => $socialUser->id,
        ], [
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'password'=>Hash::make('123'),
            'google_token' => $socialUser->token,
            'google_refresh_token' => $socialUser->refreshToken,
        ]);

        Auth::login($user);
        event(new Registered($user));
        return redirect('/dashboard');
        }
        Auth::login($registerUser);

        return redirect('/dashboard');
    }

    public function redirectfacebook(){
        return Socialite::driver('facebook')->redirect();
    }
    public function callbackfacebook(){
        $socialUser = Socialite::driver('facebook')->user();
        $registerUser=User::where('google_id',$socialUser->id)->first();
        if(!$registerUser){

           $user = User::updateOrCreate([
            'google_id' => $socialUser->id,
        ], [
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'password'=>Hash::make('123'),
            'google_token' => $socialUser->token,
            'google_refresh_token' => $socialUser->refreshToken,
        ]);

        Auth::login($user);
        event(new Registered($user));
        return redirect('/dashboard');
        }
        Auth::login($registerUser);

        return redirect('/dashboard');
    }


    public function redirectapple(){
        return Socialite::driver('apple')->redirect();
    }
    public function callbackapple(){
        $socialUser = Socialite::driver('apple')->user();
        $registerUser=User::where('google_id',$socialUser->id)->first();
        if(!$registerUser){

           $user = User::updateOrCreate([
            'google_id' => $socialUser->id,
        ], [
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'password'=>Hash::make('123'),
            'google_token' => $socialUser->token,
            'google_refresh_token' => $socialUser->refreshToken,
        ]);

        Auth::login($user);
        event(new Registered($user));
        return redirect('/dashboard');
        }
        Auth::login($registerUser);

        return redirect('/dashboard');
    }
}
