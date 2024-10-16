<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zodiacsign extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', // إضافة الحقل id هنا
        'zodiacn'

    ];
    public function weeklyHoroscopeTranslations()
    {
        return $this->hasMany(WeeklyHoroscopeTranslation::class, 'zodiacsign_id');
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'horoscope_translations')
                    ->withTimestamps();
    }
    public function weeklylanguages()
    {
        return $this->belongsToMany(Language::class, 'weekly_horoscope_translations', 'zodiacsign_id', 'language_id')
                    ->withTimestamps();
    }
}
