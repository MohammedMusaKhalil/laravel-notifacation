<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Favorite_book;
use App\Models\Favorite_color;
use App\Models\Favorite_music;
use App\Models\Hobbie;
use App\Models\Language;
use App\Models\Other_interest;
use App\Models\Zodiacsign;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $zodiacSigns=Zodiacsign::all();
        $hobbis=Hobbie::all();
        $favorite_book=Favorite_book::all();
        $favorite_color=Favorite_color::all();
        $favorite_music=Favorite_music::all();
        $other_interest=Other_interest::all();
        $languages=Language::all();
        return view('profile.edit', [
            'user' => $request->user(),
            'zodiacSigns' => $zodiacSigns,
            'hobbies'=>$hobbis,
            'favorite_books'=>$favorite_book,
            'favorite_colors'=>$favorite_color,
            'favorite_music'=>$favorite_music,
            'other_interests'=>$other_interest,
            'languages'=>$languages,
        ]);
    }
    public function editapi(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();

    // تحديث معلومات المستخدم
    $user->first_name = $request->input('first_name');
    $user->last_name = $request->input('last_name');
    $user->email = $request->input('email');

    // إذا تم تغيير البريد الإلكتروني، أعد تعيين تاريخ التحقق
    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->phone = $request->input('phone');
    $user->date_of_birth = $request->input('date_of_birth');
    $user->gender = $request->input('gender');
    $user->personality = $request->input('personality');
    $user->zodiac_sign_id = $request->input('zodiac_sign_id');
    $user->hobbie_id=$request->input('hobbie_id');
   $user->favorite_music_id=$request->input('favorite_music_id');
   $user->favorite_color_id=$request->input('favorite_color_id');
   $user->favorite_book_id=$request->input('favorite_book_id');
   $user->other_interest_id=$request->input('other_interest_id');
   $user->language_id=$request->input('language_id');
    // حفظ معلومات المستخدم
    $user->save();

    return Redirect::route('profile.edit');
}




    public function updateapi(ProfileUpdateRequest $request)
{
    $request->user()->fill($request->validated());

    if ($request->user()->isDirty('email')) {
        $request->user()->email_verified_at = null;
    }

    $request->user()->save();

    return response()->json([
        'status' => 'profile-updated',
        'user' => $request->user(),
    ]);
}


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        DB::table('notificationsuser')
        ->where('notifiable_id', $user->id)
        ->delete();

        Auth::logout();


        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function destroyapi(Request $request)
{
    $request->validateWithBag('userDeletion', [
        'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return response()->json([
        'status' => 'account-deleted',
    ]);
}
}
