<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoroscopeTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'zodiacsign_id',
        'language_id',
        'daily_id',
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
        return $this->belongsTo(ZodiacSign::class, 'Zodiacsign_id');
    }

    // Define the relationship to Daily
    public function daily()
    {
        return $this->belongsTo(Daily::class, 'daily_id');
    }

    // Define the relationship to Language
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
