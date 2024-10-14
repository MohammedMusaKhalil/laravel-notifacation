<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Str;
class NotificationController extends Controller
{

    public function index()
{
    $user = Auth::user();
    $notifications = null;

    // جلب المنطقة الزمنية المخزنة في الجلسة أو اعتماد المنطقة الزمنية الافتراضية
    $userTimezone = session('timezone', config('app.timezone'));

    // الحصول على اللغة الحالية
    $locale = App::getLocale();

    if (!$user->notifications_disabled) {
        // إذا كان `email_verified_at` فارغًا، عرض الإشعارات فقط بناءً على التاريخ
        if (is_null($user->email_verified_at)) {
            $notifications = DB::table('notificationsuser')
                ->where('notifiable_id', $user->id)
                ->where('read_at', null)
                ->whereDate('notification_date', Carbon::today($userTimezone)) // استخدام المنطقة الزمنية
                ->select(
                    'id',
                    'created_at',
                    'read_at',
                    'notification_date',
                    DB::raw("(CASE
                        WHEN '$locale' = 'ar' THEN message_ar
                        WHEN '$locale' = 'en' THEN message_en
                        WHEN '$locale' = 'fr' THEN message_fr
                        WHEN '$locale' = 'de' THEN message_de
                        ELSE message_en -- لغة افتراضية
                    END) as data") // استخدام `data` لتخزين الرسالة
                )
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
                    ->select(
                        'id',
                        'created_at',
                        'read_at',
                        'notification_date',
                        DB::raw("(CASE
                            WHEN '$locale' = 'ar' THEN message_ar
                            WHEN '$locale' = 'en' THEN message_en
                            WHEN '$locale' = 'fr' THEN message_fr
                            WHEN '$locale' = 'de' THEN message_de
                            ELSE message_en -- لغة افتراضية
                        END) as data") // استخدام `data` لتخزين الرسالة
                    )
                    ->get();
            }
        }
                $userZodiacSignId = $user->zodiac_sign_id;
                $dailyAdvice=null;
                if($user->usernotification->enableDailyTips){
                                $dailyAdvice = DB::table('advice')
                                    ->join('dailies', 'advice.id_daily', '=', 'dailies.id')
                                    ->where('advice.zodiac_sign_id', $userZodiacSignId)
                                    ->where('advice.advicetype_id',1)
                                    ->whereDate('dailies.date', Carbon::today($userTimezone))
                                    ->select(
                                        'advice.id',
                                        'advice.created_at',
                                        'dailies.date',
                                        'advice.language_id', // جلب معرف اللغة
                                        'advice.advices' // جلب النصيحة
                                    )
                                    ->get();
                }
                if($user->usernotification->enableFinancialTips){
                    $FinancialTips = DB::table('advice')
                    ->join('dailies', 'advice.id_daily', '=', 'dailies.id')
                    ->where('advice.zodiac_sign_id', $userZodiacSignId)
                    ->where('advice.advicetype_id', 2) // نصائح مالية
                    ->whereDate('dailies.date', Carbon::today($userTimezone))
                    ->select(
                        'advice.id',
                        'advice.created_at',
                        'dailies.date',
                        'advice.language_id', // جلب معرف اللغة
                        'advice.advices' // جلب النصيحة
                    )
                    ->get();
                $dailyAdvice = $dailyAdvice->merge($FinancialTips);
                }
                if($user->usernotification->enableHealthTips){
                    $HealthTips = DB::table('advice')
                    ->join('dailies', 'advice.id_daily', '=', 'dailies.id')
                    ->where('advice.zodiac_sign_id', $userZodiacSignId)
                    ->where('advice.advicetype_id', 3) // نصائح صحية
                    ->whereDate('dailies.date', Carbon::today($userTimezone))
                    ->select(
                        'advice.id',
                        'advice.created_at',
                        'dailies.date',
                        'advice.language_id', // جلب معرف اللغة
                        'advice.advices' // جلب النصيحة
                    )
                    ->get();
                $dailyAdvice = $dailyAdvice->merge($HealthTips);
                }
                if($user->usernotification->enableMarriageTips){
                    $MarriageTips = DB::table('advice')
                    ->join('dailies', 'advice.id_daily', '=', 'dailies.id')
                    ->where('advice.zodiac_sign_id', $userZodiacSignId)
                    ->where('advice.advicetype_id', 4) // نصائح زواج
                    ->whereDate('dailies.date', Carbon::today($userTimezone))
                    ->select(
                        'advice.id',
                        'advice.created_at',
                        'dailies.date',
                        'advice.language_id', // جلب معرف اللغة
                        'advice.advices' // جلب النصيحة
                    )
                    ->get();
                $dailyAdvice = $dailyAdvice->merge($MarriageTips);
                }
                if($user->usernotification->enableGirlsTips){
                    $GirlsTips = DB::table('advice')
                    ->join('dailies', 'advice.id_daily', '=', 'dailies.id')
                    ->where('advice.zodiac_sign_id', $userZodiacSignId)
                    ->where('advice.advicetype_id', 5) // نصائح بنات
                    ->whereDate('dailies.date', Carbon::today($userTimezone))
                    ->select(
                        'advice.id',
                        'advice.created_at',
                        'dailies.date',
                        'advice.language_id', // جلب معرف اللغة
                        'advice.advices' // جلب النصيحة
                    )
                    ->get();
                $dailyAdvice = $dailyAdvice->merge($GirlsTips);
                }
                if (!$dailyAdvice) {
                    $translatedAdvice = null;
                }else{

                 $translatedAdvice = $dailyAdvice->map(function($advice) use ($user) {
                    return [
                        'id' => $advice->id,
                        'created_at' => $advice->created_at,
                        'date' => $advice->date,
                        'translated_advice' => $this->translateMessage($advice->advices, $user->language->code) // استدعاء دالة الترجمة
                    ];
                });}

    }
    else{
    $translatedAdvice=null;
}

    // هنا نقوم بإرجاع النصائح المترجمة
    return view('notificatin', compact('notifications', 'translatedAdvice'));

}

public function updateNotifications(Request $request)
    {
        $user = auth()->user();

        // تحقق إذا كان لدى المستخدم `usernotification`، إذا لم يكن لديه، أنشئه.
        if (!$user->usernotification) {
            $user->usernotification->create();
        }

        // تحديث الحقول
        $user->usernotification->update([
            'enableDailyHoroscope' => $request->has('enableDailyHoroscope') ? 1 : 0,
            'enableWeeklyHoroscope' => $request->has('enableWeeklyHoroscope') ? 1 : 0,
            'enableMonthlyHoroscope' => $request->has('enableMonthlyHoroscope') ? 1 : 0,
            'enableDailyTips' => $request->has('enableDailyTips') ? 1 : 0,
            'enableFinancialTips' => $request->has('enableFinancialTips') ? 1 : 0,
            'enableGirlsTips' => $request->has('enableGirlsTips') ? 1 : 0,
            'enableHealthTips' => $request->has('enableHealthTips') ? 1 : 0,
            'enableMarriageTips' => $request->has('enableMarriageTips') ? 1 : 0,
            'enable_weekly' => $request->has('enable_weekly') ? 1 : 0,
            'enable_monthly' => $request->has('enable_monthly') ? 1 : 0,
            'lastNotificationDate' => $request->input('lastNotificationDate'),  // تعديل أو تحديث آخر وقت إشعار
        ]);

        return redirect()->back()->with('status', 'Notification settings updated successfully!');
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
        // استرجاع الرسالة المدخلة
        $message = $request->input('message');
        $notificationDate = $request->input('notification_date');
        $userId = $request->input('user_id');

        // تحديد ما إذا كانت الرسالة مرسلة للجميع
        $isForAll = ($userId == 'all');
        $users = collect(); // مجموعة فارغة للمستخدمين

        if ($isForAll) {
            // استرجاع جميع المستخدمين في حال كانت الرسالة للجميع
            $users = User::all();
        } else {
            // استرجاع المستخدم المحدد إذا كانت الرسالة موجهة لشخص معين
            $user = User::find($userId);
            if ($user) {
                $users = collect([$user]);
            }
        }

        // ترجمة الرسالة إلى اللغات المختلفة
        $translatedMessageAr = $this->translateMessage($message, 'ar');
        $translatedMessageEn = $this->translateMessage($message, 'en');
        $translatedMessageFr = $this->translateMessage($message, 'fr');
        $translatedMessageDe = $this->translateMessage($message, 'de');

        // إرسال الرسالة لكل مستخدم
        foreach ($users as $user) {
            DB::table('notificationsuser')->insert([
                'id' => Str::uuid(),
                'type' => 'App\\Notifications\\UserRegisterNotification',
                'notifiable_id' => $user->id,
                'notifiable_type' => User::class,
                'data' => $message,
                'message_ar' => $translatedMessageAr,
                'message_en' => $translatedMessageEn,
                'message_fr' => $translatedMessageFr,
                'message_de' => $translatedMessageDe,
                'notification_date' => $notificationDate,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // حفظ نسخة من الرسالة المرسلة في جدول sent_messages
        DB::table('sent_messages')->insert([
            'id' => Str::uuid(),
            'message' => $message,
            'message_ar' => $translatedMessageAr,
            'message_en' => $translatedMessageEn,
            'message_fr' => $translatedMessageFr,
            'message_de' => $translatedMessageDe,
            'notification_date' => $notificationDate,
            'is_for_all' => $isForAll, // تحديد إذا كانت الرسالة موجهة للجميع
            'user_id' => $isForAll ? null : $userId, // تخزين معرف المستخدم إذا لم تكن الرسالة للجميع
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Notification sent successfully!');
    }



        private function translateMessage($message, $locale)
        {
            $tr = new GoogleTranslate();
            $tr->setSource('auto'); // اكتشاف اللغة تلقائيًا
            $tr->setTarget($locale); // تعيين اللغة الهدف

            return $tr->translate($message);
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

        // الحصول على اللغة الحالية
        $locale = App::getLocale();

        if (!$user->notifications_disabled) {
            // إذا كان `email_verified_at` فارغًا، عرض الإشعارات فقط بناءً على التاريخ
            if (is_null($user->email_verified_at)) {
                $notifications = DB::table('notificationsuser')
                    ->where('notifiable_id', $user->id)
                    ->where('read_at', null)
                    ->whereDate('notification_date', Carbon::today($userTimezone)) // استخدام المنطقة الزمنية
                    ->select(
                        'id',
                        'created_at',
                        'read_at',
                        'notification_date',
                        DB::raw("(CASE
                            WHEN '$locale' = 'ar' THEN message_ar
                            WHEN '$locale' = 'en' THEN message_en
                            WHEN '$locale' = 'fr' THEN message_fr
                            WHEN '$locale' = 'de' THEN message_de
                            ELSE message_en -- لغة افتراضية
                        END) as data") // استخدام `data` لتخزين الرسالة
                    )
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
                        ->select(
                            'id',
                            'created_at',
                            'read_at',
                            'notification_date',
                            DB::raw("(CASE
                                WHEN '$locale' = 'ar' THEN message_ar
                                WHEN '$locale' = 'en' THEN message_en
                                WHEN '$locale' = 'fr' THEN message_fr
                                WHEN '$locale' = 'de' THEN message_de
                                ELSE message_en -- لغة افتراضية
                            END) as data") // استخدام `data` لتخزين الرسالة
                        )
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

        // الرسالة المرسلة من النموذج
        $message = $request->input('message');
        $notificationDate = $request->input('notification_date');

        $translatedMessageAr = $this->translateMessage($message, 'ar');
        $translatedMessageEn = $this->translateMessage($message, 'en');
        $translatedMessageFr = $this->translateMessage($message, 'fr');
        $translatedMessageDe = $this->translateMessage($message, 'de');
                // إرسال الرسالة لكل مستخدم
        foreach ($users as $user) {
            DB::table('notificationsuser')->insert([
                'id' => Str::uuid(), // توليد UUID
                'type' => 'App\\Notifications\\UserRegisterNotification', // تعيين نوع الإشعار
                'notifiable_id' => $user->id,
                'notifiable_type' => User::class, // تعيين نوع المستخدم
                'data' => $message,
                'message_ar' => $translatedMessageAr,
                'message_en' => $translatedMessageEn,
                'message_fr' => $translatedMessageFr,
                'message_de' => $translatedMessageDe,
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
