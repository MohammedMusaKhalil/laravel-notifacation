<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Other_interest extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsToMany(User::class, 'other_interest_user');
    }
}
