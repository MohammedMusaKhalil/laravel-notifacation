<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monthly extends Model
{
    use HasFactory;

    public function monthlyHoroscopeTranslations()
    {
        return $this->hasMany(MonthlyHoroscopeTranslation::class, 'monthly_id');
    }
}
