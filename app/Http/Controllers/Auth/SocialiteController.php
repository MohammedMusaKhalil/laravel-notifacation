<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\JsonResponse;




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





    public function redirectgoogleapi(): JsonResponse
    {
        return response()->json(['url' => Socialite::driver('google')->redirect()->getTargetUrl()]);
    }

    public function callbackgoogleapi(Request $request): JsonResponse
    {
        $socialUser = Socialite::driver('google')->user();
        $registerUser = User::where('google_id', $socialUser->id)->first();

        if (!$registerUser) {
            $user = User::create([
                'google_id' => $socialUser->id,
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'password' => Hash::make('123'), // Consider requiring the user to set a password
                'google_token' => $socialUser->token,
                'google_refresh_token' => $socialUser->refreshToken,
            ]);

            event(new Registered($user));
        } else {
            $user = $registerUser;
        }

        Auth::login($user);

        return response()->json(['status' => 'success', 'user' => $user], 200);
    }

    public function redirectfacebookapi(): JsonResponse
    {
        return response()->json(['url' => Socialite::driver('facebook')->redirect()->getTargetUrl()]);
    }

    public function callbackfacebookapi(Request $request): JsonResponse
    {
        $socialUser = Socialite::driver('facebook')->user();
        $registerUser = User::where('facebook_id', $socialUser->id)->first();

        if (!$registerUser) {
            $user = User::create([
                'facebook_id' => $socialUser->id,
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'password' => Hash::make('123'), // Consider requiring the user to set a password
            ]);

            event(new Registered($user));
        } else {
            $user = $registerUser;
        }

        Auth::login($user);

        return response()->json(['status' => 'success', 'user' => $user], 200);
    }

    public function redirectappleapi(): JsonResponse
    {
        return response()->json(['url' => Socialite::driver('apple')->redirect()->getTargetUrl()]);
    }

    public function callbackappleapi(Request $request): JsonResponse
    {
        $socialUser = Socialite::driver('apple')->user();
        $registerUser = User::where('apple_id', $socialUser->id)->first();

        if (!$registerUser) {
            $user = User::create([
                'apple_id' => $socialUser->id,
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'password' => Hash::make('123'), // Consider requiring the user to set a password
            ]);

            event(new Registered($user));
        } else {
            $user = $registerUser;
        }

        Auth::login($user);

        return response()->json(['status' => 'success', 'user' => $user], 200);
    }
}
