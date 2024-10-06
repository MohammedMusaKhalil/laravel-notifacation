<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advice extends Model
{
    use HasFactory;


    public function daily(){
            return $this->hasOne(Daily::class,'id','id_daily');
        }
    public function language()
    {
        return $this->hasOne(Language::class, 'id', 'language_id');
    }
    public function zodiacSign()
    {
        return $this->hasOne(Zodiacsign::class, 'id', 'zodiac_sign_id');
    }

    public function advicetype(){
        return $this->hasOne(Advicetype::class,'id','advicetype_id');
    }
}
