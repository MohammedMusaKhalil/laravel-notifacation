<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class adminControler extends Controller
{

    public function messages_send()
{
    // استرجاع جميع الرسائل المرسلة من جدول sent_messages
    $sentMessages = DB::table('sent_messages')->get();

    // تمرير الرسائل إلى العرض
    return view('Admin.dashbord.message_send', compact('sentMessages'));
}
    public function User_statistics()
    {
        // Blocks showing user login statistics
        $number_blocks = [
            [
                'title' => 'Users Logged In Today',
                'number' => User::whereDate('last_login_at', today())->count()
            ],
            [
                'title' => 'Users Logged In Last 7 Days',
                'number' => User::where('last_login_at', '>=', today()->subDays(7))->count()
            ],
            [
                'title' => 'Users Logged In Last 30 Days',
                'number' => User::where('last_login_at', '>=', today()->subDays(30))->count()
            ],
        ];

        // Blocks listing recent login activity and inactive users
        $list_blocks = [
            [
                'title' => 'Last Logged In Users',
                'entries' => User::orderBy('last_login_at', 'desc')
                    ->take(5)
                    ->get(),
            ],
            [
                'title' => 'Users Not Logged In For 30 Days',
                'entries' => User::where(function($query) {
                        $query->where('last_login_at', '<', today()->subDays(30))
                              ->orWhereNull('last_login_at');
                    })
                    ->orderBy('last_login_at', 'desc')
                    ->take(5)
                    ->get()
            ],
        ];

        // Get daily login data for the last 30 days
        $startDate = Carbon::now()->subDays(30);
        $loginsLast30Days = User::where('last_login_at', '>=', $startDate)
            ->selectRaw('DATE(last_login_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        // Prepare the data for the chart
        $dates = [];
        $counts = [];
        $start = $startDate->copy();
        $end = Carbon::now();

        while ($start <= $end) {
            $date = $start->format('Y-m-d');
            $dates[] = $date;
            $count = $loginsLast30Days->firstWhere('date', $date)->count ?? 0;
            $counts[] = $count;
            $start->addDay();
        }

        return view('admin.dashbord.user_statistics', compact('number_blocks', 'list_blocks', 'dates', 'counts'));
    }

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
        $totalUsers = User::count();

        // حساب عدد المستخدمين الذين أضافوا حقل phone
        $usersWithPhone = User::whereNotNull('phone')->count();

        // حساب عدد المستخدمين الذين أضافوا حقل google_id
        $usersWithEmail = User::whereNotNull('google_id')->count();

        // حساب عدد المستخدمين الذين لديهم status = 1
        $activeUsers = User::where('status', 1)->count();
        $notifications = $admin->unreadNotifications;
        return view('Admin.dashbord.dashbord', compact('notifications', 'totalUsers', 'usersWithPhone', 'usersWithEmail', 'activeUsers'));
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
