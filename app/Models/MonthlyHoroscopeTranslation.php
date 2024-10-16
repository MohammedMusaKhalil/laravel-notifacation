<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyHoroscopeTranslation extends Model
{
    use HasFactory;
    protected $fillable = [
        'zodiacsign_id',
        'language_id',
        'monthly_id',
        'generalPrediction',
        'lovePrediction',
        'financialPrediction',
        'healthPrediction',
        'Finanzial_per',
        'health',
        'loveLife',
        'occupat_per',
    ];

    public function zodiacsign()
    {
        return $this->belongsTo(ZodiacSign::class, 'zodiacsign_id');
    }

    // Define the relationship to Daily
    public function monthly()
    {
        return $this->belongsTo(Monthly::class, 'monthly_id');
    }

    // Define the relationship to Language
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
