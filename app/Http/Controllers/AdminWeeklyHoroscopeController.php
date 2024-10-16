<?php

namespace App\Http\Controllers;

use App\Models\Daily;
use App\Models\Language;
use App\Models\Weekly;
use App\Models\WeeklyHoroscopeTranslation;
use App\Models\Zodiacsign;
use Illuminate\Http\Request;

class AdminWeeklyHoroscopeController extends Controller
{
    public function index()
            {
                $horoscopes = WeeklyHoroscopeTranslation::with('weekly', 'zodiacsign', 'language')->get();

                $number_blocks = [
                    ['number' => $horoscopes->count(), 'title' => 'number of predictions'],
                ];

                return view('Admin.dashbord.weekly_horoscope.index', compact('horoscopes', 'number_blocks'));
            }
            public function create()
            {
                $zodiacSigns = Zodiacsign::all();
                $languages = Language::all();
                $weeklies = Weekly::all();

                return view('Admin.dashbord.Weekly_horoscope.create', compact('zodiacSigns', 'languages', 'weeklies'));
            }

            public function store(Request $request)
            {
                // Validate the request
                $request->validate([
                    'zodiacsign_id' => 'required|exists:zodiacsigns,id',
                    'language_id' => 'required|exists:languages,id',
                    'weekly_id' => 'required|exists:weeklies,id',
                    'generalPrediction' => 'required|string',
                    'lovePrediction' => 'required|string',
                    'financialPrediction' => 'required|string',
                    'healthPrediction' => 'required|string',
                    'warnings' => 'required|string',
                ]);

                WeeklyHoroscopeTranslation::create([
                    'zodiacsign_id' => $request->zodiacsign_id,
                    'language_id' => $request->language_id,
                    'weekly_id' => $request->weekly_id,
                    'generalPrediction' => $request->generalPrediction,
                    'lovePrediction' => $request->lovePrediction,
                    'financialPrediction' => $request->financialPrediction,
                    'healthPrediction' => $request->healthPrediction,
                    'warnings' => $request->warnings,
                ]);

                return redirect()->route('admin.weekly.horoscope')->with('success', 'Daily Horoscope added successfully!');
            }


            public function edit($id)
            {
                $horoscope = WeeklyHoroscopeTranslation::findOrFail($id);
                $zodiacSigns = Zodiacsign::all();
                $languages = Language::all();
                $weeklies = Weekly::all();
                return view('Admin.dashbord.weekly_horoscope.edit', compact('horoscope', 'zodiacSigns', 'languages','weeklies'));
            }

            public function update(Request $request, $id)
            {
                $request->validate([
                    'zodiacsign_id' => 'required|exists:zodiacsigns,id',
                    'language_id' => 'required|exists:languages,id',
                    'weekly_id' => 'required|exists:weeklies,id',
                    'generalPrediction' => 'required|string',
                    'lovePrediction' => 'required|string',
                    'financialPrediction' => 'required|string',
                    'healthPrediction' => 'required|string',
                    'warnings' => 'required|string',
                ]);

                $horoscope = WeeklyHoroscopeTranslation::findOrFail($id);

                $horoscope->zodiacsign_id = $request->zodiacsign_id;
                $horoscope->language_id = $request->language_id;
                $horoscope->weekly_id = $request->weekly_id;
                $horoscope->generalPrediction = $request->generalPrediction;
                $horoscope->lovePrediction = $request->lovePrediction;
                $horoscope->financialPrediction = $request->financialPrediction;
                $horoscope->healthPrediction = $request->healthPrediction;
                $horoscope->warnings = $request->warnings;

                $horoscope->save();                return redirect()->route('admin.weekly.horoscope')->with('success', 'Daily Horoscope updated successfully!');
            }
            public function destroy($id)
            {
                $horoscope = WeeklyHoroscopeTranslation::findOrFail($id);

                $horoscope->delete();

                return redirect()->route('admin.weekly.horoscope')->with('success', 'Horoscope deleted successfully.');
            }
}
