<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usernotification extends Model
{
    use HasFactory;
    protected $fillable = [
        'lastNotificationDate',
        'enable_monthly',
        'enable_weekly',
        'enableMarriageTips',
        'enableHealthTips',
        'enableGirlsTips',
        'enableFinancialTips',
        'enableDailyTips',
        'enableMonthlyHoroscope',
        'enableWeeklyHoroscope',
        'enableDailyHoroscope',
        'lastNotificationDate'
    ];
}
