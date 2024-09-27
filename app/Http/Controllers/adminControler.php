<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class adminControler extends Controller
{
    public function index()
    {
        $admin = Admin::find(1);
        $notifications = $admin->unreadNotifications;
        return view('Admin.dashbord.dashbord', compact('notifications'));
    }

    public function markNotification(Request $request) {
        $admin = Admin::find(1);
        $admin->unreadNotifications->when($request->input('id'),function($query) use ($request){
            return $query->where('id',$request->input('id'));
        })->markAsRead();
    }

    public function send(){
        return view('Admin.dashbord.send');
    }



    public function indexapi()
{

    // الحصول على المسؤول المسجل حاليًا
    $admin = Admin::find(1);
        $notifications = $admin->unreadNotifications;

        return response()->json([
            'status' => 'success',
            'notifications' => $notifications,
        ]);

}


    // تعيين الإشعارات كـ "مقروءة"
    public function markNotificationapi(Request $request)
    {
        $admin = Admin::find(1); // يمكن تعديل 1 ليكون هوية المسؤول المسجل حاليًا

        $admin->unreadNotifications->when($request->input('id'), function ($query) use ($request) {
            return $query->where('id', $request->input('id'));
        })->markAsRead();

        return response()->json([
            'status' => 'success',
            'message' => 'Notification marked as read.',
        ]);
    }

    // عرض استجابة تجريبية للـ API للـ 'send'
}
