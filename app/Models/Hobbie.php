<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobbie extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', // إضافة الحقل id هنا

    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'hobby_user', 'hobby_id', 'user_id');
    }
}
