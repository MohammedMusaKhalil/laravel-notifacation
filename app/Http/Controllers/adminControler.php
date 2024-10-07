<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class adminControler extends Controller
{

    public function showEmailUsers()
{
    // Get users who have a google_id
    $users = User::whereNotNull('google_id')->get();

    // Return the users (you can return a view or json depending on your needs)
    return view('admin.dashbord.users.showEmailUsers', compact('users')); // Assuming you have a view for displaying users
}

public function showPhoneUsers()
{
    // Get users who have a google_id
    $users = User::whereNotNull('phone')->get();

    // Return the users (you can return a view or json depending on your needs)
    return view('admin.dashbord.users.showPhoneUsers', compact('users')); // Assuming you have a view for displaying users
}

    public function updateStatusenable($id){
        $user = User::findOrFail($id); // البحث عن المستخدم

    // تغيير حالة المستخدم (من 1 إلى 0 أو العكس)
    $user->status = $user->status == 1 ? 0 : 1;
    $user->save();

    return redirect()->route('admin.users.enable')->with('success', 'User status updated successfully.');

    }
    public function updateStatusbanned($id){
        $user = User::findOrFail($id); // البحث عن المستخدم

    // تغيير حالة المستخدم (من 1 إلى 0 أو العكس)
    $user->status = $user->status == 1 ? 0 : 1;
    $user->save();

    return redirect()->route('admin.users.banned')->with('success', 'User status updated successfully.');

    }
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
        $users = User::all();
        return view('Admin.dashbord.send', compact('users'));
    }
    public function edit($id)
{
    $user = User::findOrFail($id); // البحث عن المستخدم المطلوب
    return view('Admin.dashbord.users.editUsers', compact('user')); // عرض صفحة تعديل المستخدم
}

public function update(Request $request, $id)
{
    // استرجاع المستخدم المطلوب بناءً على المعرف
    $user = User::findOrFail($id);

    // تحقق من البيانات مع استثناء البريد الإلكتروني الحالي
    $validatedData = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id, // استثناء البريد الإلكتروني الحالي للمستخدم
        'phone' => '',
        'date_of_birth' => '',
        'gender' => 'required|in:male,female',
    ]);

    // تحديث بيانات المستخدم
    $user->first_name = $validatedData['first_name'];
    $user->last_name = $validatedData['last_name'];
    $user->email = $validatedData['email'];
    $user->phone = $validatedData['phone'];
    $user->date_of_birth = $validatedData['date_of_birth'];
    $user->gender = $validatedData['gender'];

    // حفظ التعديلات
    $user->save();

    // إعادة التوجيه مع رسالة نجاح
    return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
}


public function destroy($id)
{
    $user = User::findOrFail($id);

    // حذف المستخدم
    $user->delete();

    return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
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
    public function showUsers()
{
    $users = User::all(); // استرجاع جميع المستخدمين من قاعدة البيانات
    return view('Admin.dashbord.users.showUsers', compact('users'));
}


    public function showEnableUsers()
{
    $activeUsers = User::where('status', 1)->get();
        return view('Admin.dashbord.users.enableUsers', compact('activeUsers'));
}
    public function showBannedUsers()
{
    $bannedUsers = User::where('status', 0)->get();
        return view('Admin.dashbord.users.bannedUsers', compact('bannedUsers'));
}

}
