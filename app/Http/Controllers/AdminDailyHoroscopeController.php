<?php

namespace App\Http\Controllers;

use App\Models\Daily;
use App\Models\HoroscopeTranslation;
use App\Models\Language;
use App\Models\Zodiacsign;
use Illuminate\Http\Request;

class AdminDailyHoroscopeController extends Controller
{
    //
    public function index()
            {
                $horoscopes = HoroscopeTranslation::with('daily', 'zodiacsign', 'language')->get();

                // قم بإضافة البيانات للكتل
                $number_blocks = [
                    ['number' => $horoscopes->count(), 'title' => 'number of predictions'],
                    // يمكنك إضافة المزيد من الكتل حسب الحاجة
                ];

                return view('Admin.dashbord.daily_horoscope.index', compact('horoscopes', 'number_blocks'));
            }
            public function create()
            {
                $zodiacSigns = ZodiacSign::all();
                $languages = Language::all();
                $dailies = Daily::all(); // Assuming you have a Daily model

                return view('Admin.dashbord.daily_horoscope.create', compact('zodiacSigns', 'languages', 'dailies'));
            }


public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'zodiac_sign_id' => 'required|exists:zodiacsigns,id',
        'language_id' => 'required|exists:languages,id',
        'daily_id' => 'required|exists:dailies,id', // Make sure daily_id is validated
        'generalPrediction' => 'required|string',
        'lovePrediction' => 'required|string',
        'financialPrediction' => 'required|string',
        'healthPrediction' => 'required|string',
        'Finanzial_per' => 'required|numeric',
        'health' => 'required|numeric',
        'loveLife' => 'required|numeric',
        'occupat_per' => 'required|numeric',
    ]);

    // Create a new HoroscopeTranslation with all the necessary fields
    HoroscopeTranslation::create([
        'zodiacsign_id' => $request->zodiac_sign_id,
        'language_id' => $request->language_id,
        'daily_id' => $request->daily_id, // Add daily_id here
        'generalPrediction' => $request->generalPrediction,
        'lovePrediction' => $request->lovePrediction,
        'financialPrediction' => $request->financialPrediction,
        'healthPrediction' => $request->healthPrediction,
        'Finanzial_per' => $request->Finanzial_per,
        'health' => $request->health,
        'loveLife' => $request->loveLife,
        'occupat_per' => $request->occupat_per,
    ]);

    return redirect()->route('admin.daily.horoscope')->with('success', 'Daily Horoscope added successfully!');
}


public function edit($id)
{
    $horoscope = HoroscopeTranslation::findOrFail($id);
    $zodiacSigns = Zodiacsign::all();
    $languages = Language::all();
    $dailies = Daily::all(); // Assuming you have a Daily model
    return view('Admin.dashbord.daily_horoscope.edit', compact('horoscope', 'zodiacSigns', 'languages','dailies'));
}

public function update(Request $request, $id)
{

    $request->validate([
        'zodiacsign_id' => 'required|exists:zodiacsigns,id',
        'language_id' => 'required|exists:languages,id',
        'daily_id' => 'required|exists:dailies,id',// Add daily_id here
        'generalPrediction' => 'required|string',
        'lovePrediction' => 'required|string',
        'financialPrediction' => 'required|string',
        'healthPrediction' => 'required|string',
        'Finanzial_per' => 'required|numeric',
        'health' => 'required|numeric',
        'loveLife' => 'required|numeric',
        'occupat_per' => 'required|numeric',
    ]);

    $horoscope = HoroscopeTranslation::findOrFail($id);
    $horoscope->zodiacsign_id = $request->zodiacsign_id;
    $horoscope->language_id = $request->language_id;
    $horoscope->daily_id = $request->daily_id;
    $horoscope->generalPrediction = $request->generalPrediction;
    $horoscope->lovePrediction = $request->lovePrediction;
    $horoscope->financialPrediction = $request->financialPrediction;
    $horoscope->healthPrediction = $request->healthPrediction;
    $horoscope->Finanzial_per = $request->Finanzial_per;
    $horoscope->health = $request->health;
    $horoscope->loveLife = $request->loveLife;
    $horoscope->occupat_per = $request->occupat_per;
    //$horoscope->update($request->all());

    $horoscope->save();

    return redirect()->route('admin.daily.horoscope')->with('success', 'Daily Horoscope updated successfully!');
}
public function destroy($id)
{
    // Find the horoscope by ID
    $horoscope = HoroscopeTranslation::findOrFail($id);

    // Delete the horoscope
    $horoscope->delete();

    // Redirect back with a success message
    return redirect()->route('admin.daily.horoscope')->with('success', 'Horoscope deleted successfully.');
}

}
