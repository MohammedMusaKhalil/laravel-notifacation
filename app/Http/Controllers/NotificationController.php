<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = null;

        // جلب المنطقة الزمنية المخزنة في الجلسة أو اعتماد المنطقة الزمنية الافتراضية
        $userTimezone = session('timezone', config('app.timezone'));

        if (!$user->notifications_disabled) {
            // إذا كان `email_verified_at` فارغًا، عرض الإشعارات فقط بناءً على التاريخ
            if (is_null($user->email_verified_at)) {
                $notifications = DB::table('notificationsuser')
                    ->where('notifiable_id', $user->id)
                    ->where('read_at', null)
                    ->whereDate('notification_date', Carbon::today($userTimezone)) // استخدام المنطقة الزمنية
                    ->get();
            } else {
                // استخدم الوقت الحالي بناءً على المنطقة الزمنية للمستخدم
                $currentTime = Carbon::now($userTimezone);
                $currentTimeString = $currentTime->toTimeString();

                $storedTime = Carbon::parse($user->email_verified_at, $userTimezone)->toTimeString();
                if ($currentTimeString >= $storedTime) {
                    $notifications = DB::table('notificationsuser')
                        ->where('notifiable_id', $user->id)
                        ->where('read_at', null)
                        ->whereDate('notification_date', Carbon::today($userTimezone)) // استخدام المنطقة الزمنية
                        ->get();
                }
            }
        }
        return view('notificatin', compact('notifications')); // تمرير الإشعارات إلى العرض
    }


        public function markAsRead($id)
    {
        // تحديث الإشعار كـ "مقروء"
        DB::table('notificationsuser')
            ->where('id', $id)
            ->update(['read_at' => now()]);

        // إعادة التوجيه بعد التحديث
        return redirect()->route('dashboard.notification')->with('success', 'Notification marked as read.');
    }


    public function toggleNotifications(Request $request)
    {
        $user = auth()->user();

        DB::table('users')->where('id', $user->id)->update([
            'notifications_disabled' => $request->has('notifications_disabled'),
        ]);

        return redirect()->back()->with('success', 'Notification settings updated.');
    }


        public function sendToAllUsers(Request $request)
        {
            // استرجاع جميع المستخدمين
            $users = User::all();

            // الرسالة المرسلة من النموذج
            $message = $request->input('message');
            $notificationDate = $request->input('notification_date');
            // إرسال الرسالة لكل مستخدم
            foreach ($users as $user) {
                DB::table('notificationsuser')->insert([
                    'id' => Str::uuid(), // توليد UUID
                    'type' => 'App\\Notifications\\UserRegisterNotification', // تعيين نوع الإشعار
                    'notifiable_id' => $user->id,
                    'notifiable_type' => User::class, // تعيين نوع المستخدم
                    'data' => $message,
                    'notification_date' => $notificationDate,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return redirect()->back()->with('success', 'Notification sent to all users successfully!');
        }
        public function updateNotificationTime(Request $request)
    {
        $user = auth()->user();

        DB::table('users')->where('id', $user->id)->update([
            'email_verified_at' => $request->input('email_verified_at'),
        ]);


        return redirect()->back()->with('status', 'Notification time updated successfully.');
    }





    public function indexapi()
    {
        $user = Auth::user();
        $notifications = null;

        // جلب المنطقة الزمنية المخزنة في الجلسة أو اعتماد المنطقة الزمنية الافتراضية
        $userTimezone = session('timezone', config('app.timezone'));

        if (!$user->notifications_disabled) {
            // إذا كان `email_verified_at` فارغًا، عرض الإشعارات فقط بناءً على التاريخ
            if (is_null($user->email_verified_at)) {
                $notifications = DB::table('notificationsuser')
                    ->where('notifiable_id', $user->id)
                    ->where('read_at', null)
                    ->whereDate('notification_date', Carbon::today($userTimezone)) // استخدام المنطقة الزمنية
                    ->get();
            } else {
                // استخدم الوقت الحالي بناءً على المنطقة الزمنية للمستخدم
                $currentTime = Carbon::now($userTimezone);
                $currentTimeString = $currentTime->toTimeString();

                $storedTime = Carbon::parse($user->email_verified_at, $userTimezone)->toTimeString();
                if ($currentTimeString >= $storedTime) {
                    $notifications = DB::table('notificationsuser')
                        ->where('notifiable_id', $user->id)
                        ->where('read_at', null)
                        ->whereDate('notification_date', Carbon::today($userTimezone)) // استخدام المنطقة الزمنية
                        ->get();
                }
            }
        }

        return response()->json($notifications);
     }

    // تعيين الإشعار كـ "مقروء"
    public function markAsReadapi($id)
    {
        DB::table('notificationsuser')
            ->where('id', $id)
            ->update(['read_at' => now()]);

        return response()->json(['message' => 'Notification marked as read.']);
    }

    // تمكين أو تعطيل الإشعارات
    public function toggleNotificationsapi(Request $request)
    {
        $user = Auth::user();

        DB::table('users')->where('id', $user->id)->update([
            'notifications_disabled' => $request->has('notifications_disabled'),
        ]);

        return response()->json(['message' => 'Notification settings updated successfully.']);
    }

    // إرسال إشعار لجميع المستخدمين
    public function sendToAllUsersapi(Request $request)
    {
        $users = User::all();
        $message = $request->input('message');
        $notificationDate = $request->input('notification_date');

        foreach ($users as $user) {
            DB::table('notificationsuser')->insert([
                'id' => Str::uuid(),
                'type' => 'App\\Notifications\\UserRegisterNotification',
                'notifiable_id' => $user->id,
                'notifiable_type' => User::class,
                'data' => $message,
                'notification_date' => $notificationDate,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json(['message' => 'Notification sent to all users successfully!']);
    }

    // تحديث وقت الإشعار
    public function updateNotificationTimeapi(Request $request)
    {
        $user = Auth::user();

        DB::table('users')->where('id', $user->id)->update([
            'email_verified_at' => $request->input('email_verified_at'),
        ]);

        return response()->json(['message' => 'Notification time updated successfully.']);
    }

}
