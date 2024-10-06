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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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

        $user = Auth::user();

        $user1 = User::where('id', 1)->first();
        $notifications = DB::table('notificationsuser')
                    ->where('notifiable_id', $user1->id)
                    ->get();

        // التأكد من وجود المستخدم الحالي
        if ($user) {
            foreach ($notifications as $notification) {
                // إرسال الإشعارات (يمكنك تعديل هذه الطريقة بناءً على كيفية إرسال الإشعارات في تطبيقك)
                DB::table('notificationsuser')->insert([
                    'id' => Str::uuid(), // توليد UUID
                    'notifiable_id' => $user->id,
                    'notifiable_type' => $notification->notifiable_type,
                    'type' => $notification->type,
                    'data' => $notification->data,
                    'message_ar' => $notification->message_ar,
                    'message_en' => $notification->message_en,
                    'message_fr' => $notification->message_fr,
                    'message_de' => $notification->message_de,
                    'notification_date'=>$notification->notification_date,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
    }

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
        $user = Auth::user();
        $user1 = User::where('id', 1)->first();
        $notifications = DB::table('notificationsuser')
                    ->where('notifiable_id', $user1->id)
                    ->get();

        // التأكد من وجود المستخدم الحالي
        if ($user) {
            foreach ($notifications as $notification) {
                // إرسال الإشعارات (يمكنك تعديل هذه الطريقة بناءً على كيفية إرسال الإشعارات في تطبيقك)
                DB::table('notificationsuser')->insert([
                    'id' => Str::uuid(), // توليد UUID
                    'notifiable_id' => $user->id,
                    'notifiable_type' => $notification->notifiable_type,
                    'type' => $notification->type,
                    'data' => $notification->data,
                    'message_ar' => $notification->message_ar,
                    'message_en' => $notification->message_en,
                    'message_fr' => $notification->message_fr,
                    'message_de' => $notification->message_de,
                    'notification_date'=>$notification->notification_date,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
    }
        return redirect('/dashboard');
        }
        Auth::login($registerUser);
        $user = Auth::user();



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
        $user = Auth::user();
        $user1 = User::where('id', 1)->first();
        $notifications = DB::table('notificationsuser')
                    ->where('notifiable_id', $user1->id)
                    ->get();

        // التأكد من وجود المستخدم الحالي
        if ($user) {
            foreach ($notifications as $notification) {
                // إرسال الإشعارات (يمكنك تعديل هذه الطريقة بناءً على كيفية إرسال الإشعارات في تطبيقك)
                DB::table('notificationsuser')->insert([
                    'id' => Str::uuid(), // توليد UUID
                    'notifiable_id' => $user->id,
                    'notifiable_type' => $notification->notifiable_type,
                    'type' => $notification->type,
                    'data' => $notification->data,
                    'message_ar' => $notification->message_ar,
                    'message_en' => $notification->message_en,
                    'message_fr' => $notification->message_fr,
                    'message_de' => $notification->message_de,
                    'notification_date'=>$notification->notification_date,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
    }
        return redirect('/dashboard');
        }
        Auth::login($registerUser);
        $user = Auth::user();

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
            Auth::login($user);
            $user = Auth::user();
            $user1 = User::where('id', 1)->first();
            $notifications = DB::table('notificationsuser')
                        ->where('notifiable_id', $user1->id)
                        ->get();

            // التأكد من وجود المستخدم الحالي
            if ($user) {
                foreach ($notifications as $notification) {
                    // إرسال الإشعارات (يمكنك تعديل هذه الطريقة بناءً على كيفية إرسال الإشعارات في تطبيقك)
                    DB::table('notificationsuser')->insert([
                        'id' => Str::uuid(), // توليد UUID
                        'notifiable_id' => $user->id,
                        'notifiable_type' => $notification->notifiable_type,
                        'type' => $notification->type,
                        'data' => $notification->data,
                        'message_ar' => $notification->message_ar,
                        'message_en' => $notification->message_en,
                        'message_fr' => $notification->message_fr,
                        'message_de' => $notification->message_de,
                        'notification_date'=>$notification->notification_date,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
        }
        } else {
            $user = $registerUser;
        }

        Auth::login($user);
        $user = Auth::user();

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
            Auth::login($user);
            $user = Auth::user();
            $user1 = User::where('id', 1)->first();
            $notifications = DB::table('notificationsuser')
                        ->where('notifiable_id', $user1->id)
                        ->get();

            // التأكد من وجود المستخدم الحالي
            if ($user) {
                foreach ($notifications as $notification) {
                    // إرسال الإشعارات (يمكنك تعديل هذه الطريقة بناءً على كيفية إرسال الإشعارات في تطبيقك)
                    DB::table('notificationsuser')->insert([
                        'id' => Str::uuid(), // توليد UUID
                        'notifiable_id' => $user->id,
                        'notifiable_type' => $notification->notifiable_type,
                        'type' => $notification->type,
                        'data' => $notification->data,
                        'message_ar' => $notification->message_ar,
                        'message_en' => $notification->message_en,
                        'message_fr' => $notification->message_fr,
                        'message_de' => $notification->message_de,
                        'notification_date'=>$notification->notification_date,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
        }
        } else {
            $user = $registerUser;
        }

        Auth::login($user);
        $user = Auth::user();

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
            Auth::login($user);
            $user = Auth::user();
            $user1 = User::where('id', 1)->first();
            $notifications = DB::table('notificationsuser')
                        ->where('notifiable_id', $user1->id)
                        ->get();

            // التأكد من وجود المستخدم الحالي
            if ($user) {
                foreach ($notifications as $notification) {
                    // إرسال الإشعارات (يمكنك تعديل هذه الطريقة بناءً على كيفية إرسال الإشعارات في تطبيقك)
                    DB::table('notificationsuser')->insert([
                        'id' => Str::uuid(), // توليد UUID
                        'notifiable_id' => $user->id,
                        'notifiable_type' => $notification->notifiable_type,
                        'type' => $notification->type,
                        'data' => $notification->data,
                        'message_ar' => $notification->message_ar,
                        'message_en' => $notification->message_en,
                        'message_fr' => $notification->message_fr,
                        'message_de' => $notification->message_de,
                        'notification_date'=>$notification->notification_date,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
        }
        } else {
            $user = $registerUser;
        }

        Auth::login($user);
        $user = Auth::user();

        return response()->json(['status' => 'success', 'user' => $user], 200);
    }
}
