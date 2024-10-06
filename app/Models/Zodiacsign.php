<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zodiacsign extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', // إضافة الحقل id هنا

    ];

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'horoscope_translations')
                    ->withTimestamps();
    }
}
