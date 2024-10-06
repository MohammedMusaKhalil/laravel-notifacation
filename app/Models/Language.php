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

    public function Zodiacsign()
    {
        return $this->belongsToMany(Zodiacsign::class, 'horoscope_translations')
                    ->withTimestamps();
    }
}
