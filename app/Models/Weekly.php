<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weekly extends Model
{
    use HasFactory;

    protected $fillable = [
        'weekly',   // إضافة الحقول المطلوبة هنا
        'year',
    ];

    public function weeklyHoroscopeTranslations()
    {
        return $this->hasMany(WeeklyHoroscopeTranslation::class, 'weekly_id');
    }
}
