<?php

namespace App\Http\Controllers;

use App\Models\Advice;
use App\Models\Advicetype;
use App\Models\Daily;
use App\Models\Language;
use App\Models\Zodiacsign;
use Illuminate\Http\Request;

class AdminAdviceController extends Controller
{
     public function index(){
        // جلب النصائح اليومية مع العلاقات
        $dailyTips = Advice::with(['daily', 'language', 'zodiacSign', 'advicetype'])->get();

        // تحضير البيانات لتظهر بشكل بلوكات وأقسام
        $number_blocks = [
            ['number' => $dailyTips->count(), 'title' => 'Total Advice'],
            // يمكن إضافة بلوكات أخرى هنا حسب الحاجة
        ];

        $list_blocks = [
            [
                'title' => 'Daily Advice List',
                'entries' => $dailyTips
            ],
        ];

        return view('admin.dashbord.advice.daily-tips', compact('number_blocks', 'list_blocks'));
    }
    public function create()
    {
        return view('admin.dashbord.advice.create-tip', [
            'dailies' => Daily::all(),
            'languages' => Language::all(),
            'zodiacSigns' => Zodiacsign::all(),
            'advicetypes' => Advicetype::all(),
        ]);
    }

    // تخزين النصيحة الجديدة
    public function store(Request $request)
    {
        $request->validate([
            'advices' => 'required',
            'id_daily' => 'nullable|exists:dailies,id',
            'language_id' => 'nullable|exists:languages,id',
            'zodiac_sign_id' => 'nullable|exists:zodiacsigns,id',
            'advicetype_id' => 'nullable|exists:advicetypes,id',
        ]);

        Advice::create($request->all());
        return redirect()->route('admin.dashbord.daily.tips')->with('success', 'Advice created successfully.');
    }

    // عرض صفحة تعديل النصيحة
    public function edit(Advice $advice)
    {
        return view('admin.dashbord.advice.edit-tip', [
            'advice' => $advice,
            'dailies' => Daily::all(),
            'languages' => Language::all(),
            'zodiacSigns' => Zodiacsign::all(),
            'advicetypes' => Advicetype::all(),
        ]);
    }

    // تحديث النصيحة
    public function update(Request $request, Advice $advice)
    {
        $request->validate([
            'advices' => 'required',
            'id_daily' => 'nullable|exists:dailies,id',
            'language_id' => 'nullable|exists:languages,id',
            'zodiac_sign_id' => 'nullable|exists:zodiacsigns,id',
            'advicetype_id' => 'nullable|exists:advicetypes,id',
        ]);

        $advice->update($request->all());
        return redirect()->route('admin.dashbord.daily.tips')->with('success', 'Advice updated successfully.');
    }

    // حذف النصيحة
    public function destroy(Advice $advice)
    {
        $advice->delete();
        return redirect()->route('admin.dashbord.daily.tips')->with('success', 'Advice deleted successfully.');
    }

}
