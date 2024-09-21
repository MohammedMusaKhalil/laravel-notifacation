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
    // عرض الإشعارات للمستخدم
    public function indexapi()
    {
        $user = Auth::user();
        $notifications = [];

        if (!$user->notifications_disabled) {
            // إذا كان `email_verified_at` فارغًا، عرض الإشعارات بناءً على التاريخ
            if (is_null($user->email_verified_at)) {
                $notifications = DB::table('notificationsuser')
                    ->where('notifiable_id', $user->id)
                    ->whereNull('read_at')
                    ->where('notification_date', date('Y-m-d'))
                    ->get();
            } else {
                // مقارنة الوقت الحالي مع الوقت المخزن في `email_verified_at`
                $currentTime = Carbon::now();
                $newTime = $currentTime->addHours(3);
                $newTimeString = $newTime->toTimeString();

                $storedTime = Carbon::parse($user->email_verified_at)->toTimeString();
                if ($newTimeString >= $storedTime) {
                    $notifications = DB::table('notificationsuser')
                        ->where('notifiable_id', $user->id)
                        ->whereNull('read_at')
                        ->where('notification_date', date('Y-m-d'))
                        ->get();
                }
            }
        }

        // إرجاع البيانات كـ JSON
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
