<?php

namespace App\Http\Controllers;

use App\Models\MonthlyHoroscopeTranslation; // تأكد من وجود النموذج المناسب
use App\Models\Language;
use App\Models\Monthly;
use App\Models\Zodiacsign;
use Illuminate\Http\Request;

class AdminMonthlyHoroscopeController extends Controller
{
    public function index()
    {
        $horoscopes = MonthlyHoroscopeTranslation::with('zodiacsign', 'language','monthly')->get();

        // إضافة البيانات للكتل
        $number_blocks = [
            ['number' => $horoscopes->count(), 'title' => 'عدد التوقعات'],
            // يمكنك إضافة المزيد من الكتل حسب الحاجة
        ];

        return view('Admin.dashbord.monthly_horoscope.index', compact('horoscopes', 'number_blocks'));
    }

    public function create()
    {
        $zodiacSigns = Zodiacsign::all();
        $languages = Language::all();
        $monthlies=Monthly::all();

        return view('Admin.dashbord.monthly_horoscope.create', compact('zodiacSigns', 'languages','monthlies'));
    }

    public function store(Request $request)
    {

        $request->validate([
        'zodiac_sign_id' => 'required|exists:zodiacsigns,id',
        'language_id' => 'required|exists:languages,id',
        'monthly_id' => 'required|exists:monthlies,id',
        'generalPrediction' => 'required|string',
        'lovePrediction' => 'required|string',
        'financialPrediction' => 'required|string',
        'healthPrediction' => 'required|string',
        'Finanzial_per' => 'required|numeric',
        'health' => 'required|numeric',
        'loveLife' => 'required|numeric',
        'occupat_per' => 'required|numeric',
        ]);

        // Create a new MonthlyHoroscopeTranslation with all the necessary fields
        MonthlyHoroscopeTranslation::create([
            'zodiacsign_id' => $request->zodiac_sign_id,
            'language_id' => $request->language_id,
            'monthly_id' => $request->monthly_id,
            'generalPrediction' => $request->generalPrediction,
            'lovePrediction' => $request->lovePrediction,
            'financialPrediction' => $request->financialPrediction,
            'healthPrediction' => $request->healthPrediction,
            'Finanzial_per' => $request->Finanzial_per,
            'health' => $request->health,
            'loveLife' => $request->loveLife,
            'occupat_per' => $request->occupat_per,
        ]);

        return redirect()->route('admin.monthly.horoscope')->with('success', 'Monthly Horoscope added successfully!');
    }

    public function edit($id)
    {
        $horoscope = MonthlyHoroscopeTranslation::findOrFail($id);
        $zodiacSigns = Zodiacsign::all();
        $languages = Language::all();
        $monthlies=Monthly::all();

        return view('Admin.dashbord.monthly_horoscope.edit', compact('horoscope', 'zodiacSigns', 'languages','monthlies'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
        'zodiacsign_id' => 'required|exists:zodiacsigns,id',
        'language_id' => 'required|exists:languages,id',
        'monthly_id' => 'required|exists:monthlies,id',
        'generalPrediction' => 'required|string',
        'lovePrediction' => 'required|string',
        'financialPrediction' => 'required|string',
        'healthPrediction' => 'required|string',
        'Finanzial_per' => 'required|numeric',
        'health' => 'required|numeric',
        'loveLife' => 'required|numeric',
        'occupat_per' => 'required|numeric',
        ]);

        $horoscope = MonthlyHoroscopeTranslation::findOrFail($id);

        // Update fields individually
        $horoscope->zodiacsign_id = $request->zodiacsign_id;
        $horoscope->language_id = $request->language_id;
        $horoscope->monthly_id = $request->monthly_id;
        $horoscope->generalPrediction = $request->generalPrediction;
        $horoscope->lovePrediction = $request->lovePrediction;
        $horoscope->financialPrediction = $request->financialPrediction;
        $horoscope->healthPrediction = $request->healthPrediction;
        $horoscope->Finanzial_per = $request->Finanzial_per;
        $horoscope->health = $request->health;
        $horoscope->loveLife = $request->loveLife;
        $horoscope->occupat_per = $request->occupat_per;

        // Save the updated horoscope
        $horoscope->save();

        return redirect()->route('admin.monthly.horoscope')->with('success', 'Monthly Horoscope updated successfully!');
    }

    public function destroy($id)
    {
        // Find the horoscope by ID
        $horoscope = MonthlyHoroscopeTranslation::findOrFail($id);

        // Delete the horoscope
        $horoscope->delete();

        // Redirect back with a success message
        return redirect()->route('admin.monthly.horoscope')->with('success', 'Horoscope deleted successfully.');
    }
}
