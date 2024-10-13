<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'date_of_birth',
        'gender',
        'status',
        'personality',
        'zodiac_sign_id',
        'other_interest_id',
        'language_id',
        'hobbie_id',
        'favorite_music_id',
        'favorite_color_id',
        'favorite_book_id',

        'email_verified_at',
        'notifications_disabled',
        'notifications_in_watsapp',
        'google_id',
        'google_token',
        'google_refresh_token',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // علاقة مع Zodiacsign
    public function zodiacSign()
    {
        return $this->hasOne(Zodiacsign::class, 'id', 'zodiac_sign_id');
    }

    // علاقة مع Other_interest
    public function otherInterests()
    {
        return $this->hasOne(Other_interest::class, 'id', 'other_interest_id');
    }

    // علاقة مع Language
    public function language()
    {
        return $this->hasOne(Language::class, 'id', 'language_id');
    }

    // علاقة مع Hobbie
    public function hobbies()
    {
        return $this->hasOne(Hobbie::class, 'id', 'hobbie_id');
    }

    // علاقة مع Favorite_music
    public function favoriteMusic()
    {
        return $this->hasOne(Favorite_music::class, 'id', 'favorite_music_id');
    }

    // علاقة مع Favorite_color
    public function favoriteColors()
    {
        return $this->hasOne(Favorite_color::class, 'id', 'favorite_color_id');
    }

    // علاقة مع Favorite_book
    public function favoriteBooks()
    {
        return $this->hasOne(Favorite_book::class, 'id', 'favorite_book_id');
    }
    public function usernotification()
    {
        return $this->hasOne(Usernotification::class, 'userId');
    }



    protected static function booted()
{
    static::created(function ($user) {
        // Automatically create a usernotification entry
        $user->usernotification()->create([
            'enableDailyHoroscope' => 0, // Default value
            'enableWeeklyHoroscope' => 0,
            'enableMonthlyHoroscope' => 0,
            // Add other default fields here
        ]);
    });
}

}
