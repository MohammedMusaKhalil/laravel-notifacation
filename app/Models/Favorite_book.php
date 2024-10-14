<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite_book extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', // إضافة الحقل id هنا

    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'favorite_book_user');
    }
}
