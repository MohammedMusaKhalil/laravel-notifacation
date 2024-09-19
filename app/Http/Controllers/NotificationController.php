<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class NotificationController extends Controller
{
    public function index()
    {   $user = Auth::user();
        $notifications=null;
        if(!$user->notifications_disabled){
        $notifications = DB::table('notificationsuser')
                        ->where('notifiable_id', $user->id)
                        ->where('read_at', null)
                        ->get();

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

        // إرسال الرسالة لكل مستخدم
        foreach ($users as $user) {
            DB::table('notificationsuser')->insert([
                'id' => Str::uuid(), // توليد UUID
                'type' => 'App\\Notifications\\UserRegisterNotification', // تعيين نوع الإشعار
                'notifiable_id' => $user->id,
                'notifiable_type' => User::class, // تعيين نوع المستخدم
                'data' => $message,
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

}
