<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', // إضافة الحقل id هنا

    ];
    public function weeklyHoroscopeTranslations()
    {
        return $this->hasMany(WeeklyHoroscopeTranslation::class, 'language_id');
    }
    public function monthlyHoroscopeTranslations()
    {
        return $this->hasMany(MonthlyHoroscopeTranslation::class, 'monthly_id');
    }
    public function Zodiacsign()
    {
        return $this->belongsToMany(Zodiacsign::class, 'horoscope_translations')
                    ->withTimestamps();
    }
    public function weeklyzodiacsigns()
    {
        return $this->belongsToMany(Zodiacsign::class, 'weekly_horoscope_translations', 'language_id', 'zodiacsign_id')
                    ->withTimestamps();
    }
}
