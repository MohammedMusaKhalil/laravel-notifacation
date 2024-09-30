<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Exception;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WhatsappController extends Controller
{
    public function index()
    {
    	return view('whatsapp');
    }

    function store(Request $request)
    {
	//Note : Both the form and to numbers should be defined like whatsapp:CountryCode+PhoneNumber
	//For example
	//whatsapp:+1234567
    	$twilioSid = env('TWILIO_SID');
    	$twilioAuthToken = env('TWILIO_AUTH_TOKEN');
    	$twilioWhatsappNumber = 'whatsapp:'.env('TWILIO_WHATSAPP_NUMBER');
    	$to = 'whatsapp:'.$request->phone;
    	$message = $request->message;

    	$client = new Client($twilioSid, $twilioAuthToken);

    	try {
    		$message = $client->messages->create(
    			$to,
    			array(
    				'from' => $twilioWhatsappNumber,
    				'body' => $message
    			)
    		);
    		return "Message sent successfully! SID: " . $message->sid;
    	} catch (Exception $e) {
    		return "Error sending message: " . $e->getMessage();
    	}
    }

    public function toggleNotifications(Request $request)
    {
        $user = auth()->user();
        $userTimezone = session('timezone', config('app.timezone'));

        DB::table('users')->where('id', $user->id)->update([
            'notifications_in_watsapp' => $request->has('notifications_in_watsapp'),
        ]);

       // إذا كانت الإشعارات مفعلة، أرسل الإشعارات
    if (!$user->notifications_in_watsapp) {
        // الحصول على الإشعارات الخاصة بالمستخدم
        $notifications = DB::table('notificationsuser')
            ->where('notifiable_id', $user->id)
            ->where('read_at', null)
            ->whereDate('notification_date', Carbon::today($userTimezone)) // استخدام المنطقة الزمنية
            ->get();

        $twilioSid = env('TWILIO_SID');
        $twilioAuthToken = env('TWILIO_AUTH_TOKEN');
        $twilioWhatsappNumber = 'whatsapp:' . env('TWILIO_WHATSAPP_NUMBER');
        $to = 'whatsapp:' . $user->phone;

        $client = new Client($twilioSid, $twilioAuthToken);

        // إرسال كل إشعار غير مقروء
        foreach ($notifications as $notification) {
            $message = $notification->data; // افترض أن 'data' تحتوي على الرسالة

            try {
                $client->messages->create(
                    $to,
                    [
                        'from' => $twilioWhatsappNumber,
                        'body' => $message,
                    ]
                );
            } catch (Exception $e) {
                // تسجيل الخطأ أو التعامل معه حسب الحاجة
                return "Error sending message: " . $e->getMessage();
            }
        }
    }

    return redirect()->back()->with('success', 'Notification settings updated.');
    }

}
