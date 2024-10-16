<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyHoroscopeTranslation extends Model
{
    use HasFactory;
    protected $fillable = [
        'zodiacsign_id',
        'language_id',
        'weekly_id',
        'generalPrediction',
        'lovePrediction',
        'financialPrediction',
        'healthPrediction',
       'warnings',
    ];


    public function zodiacsign()
    {
        return $this->belongsTo(ZodiacSign::class, 'zodiacsign_id');
    }

    // Define the relationship to Daily
    public function weekly()
    {
        return $this->belongsTo(Weekly::class, 'weekly_id');
    }

    // Define the relationship to Language
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
