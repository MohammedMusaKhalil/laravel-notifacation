<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\UserRegisterNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */



    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
       // $user->notify(new UserRegisterNotification($user));

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

        return redirect(RouteServiceProvider::HOME);
    }


    public function storeapi(Request $request): JsonResponse
    {
        // التحقق من صحة البيانات
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // إذا فشل التحقق من الصحة، نعيد الأخطاء
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); // 422 Unprocessable Entity
        }

        // إنشاء المستخدم
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
    event(new Registered($user));
        // إعادة استجابة JSON بنجاح
        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201); // 201 Created
    }




}
