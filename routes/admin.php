<?php

use App\Http\Controllers\AdminAdviceController;
use App\Http\Controllers\adminControler;
use App\Http\Controllers\AdminDailyHoroscopeController;
use App\Http\Controllers\AdminWeeklyHoroscopeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//admin routes
Route::prefix('admin')->name('admin.')->group(function(){
Route::middleware(['web', 'isAdmin'])->group(function(){
    Route::get('/dashbord',[adminControler::class,'index'])->name('dashbord');
    Route::get('/dashbord/send',[adminControler::class,'send'])->name('dashbord.send');
    Route::post('/notifications/send', [NotificationController::class, 'sendToAllUsers'])->name('notifications.send');

    Route::get('/dashbord/messages_send',[adminControler::class,'messages_send'])->name('dashbord.Users_messages');

    Route::get('/daily-horoscope', [AdminDailyHoroscopeController::class, 'index'])->name('daily.horoscope');
    Route::get('/daily-horoscope/create', [AdminDailyHoroscopeController::class, 'create'])->name('daily.horoscope.create');
    Route::post('/daily-horoscope', [AdminDailyHoroscopeController::class, 'store'])->name('daily.horoscope.store');
    Route::get('/daily-horoscope/{id}/edit', [AdminDailyHoroscopeController::class, 'edit'])->name('daily.horoscope.edit');
    Route::put('/daily-horoscope/{id}', [AdminDailyHoroscopeController::class, 'update'])->name('daily.horoscope.update');
    Route::delete('/daily-horoscope/{id}', [AdminDailyHoroscopeController::class, 'destroy'])->name('daily.horoscope.destroy');

    Route::get('/weekly-horoscope', [AdminWeeklyHoroscopeController::class, 'index'])->name('weekly.horoscope');
    Route::get('/weekly-horoscope/create', [AdminWeeklyHoroscopeController::class, 'create'])->name('weekly.horoscope.create');
    Route::post('/weekly-horoscope', [AdminWeeklyHoroscopeController::class, 'store'])->name('weekly.horoscope.store');
    Route::get('/weekly-horoscope/{id}/edit', [AdminWeeklyHoroscopeController::class, 'edit'])->name('weekly.horoscope.edit');
    Route::put('/weekly-horoscope/{id}', [AdminWeeklyHoroscopeController::class, 'update'])->name('weekly.horoscope.update');
    Route::delete('/weekly-horoscope/{id}', [AdminWeeklyHoroscopeController::class, 'destroy'])->name('weekly.horoscope.destroy');


    Route::get('/daily-tips', [AdminAdviceController::class, 'index'])->name('dashbord.daily.tips');
    Route::get('/tips/create', [AdminAdviceController::class, 'create'])->name('dashbord.tips.create');  // صفحة إنشاء نصيحة جديدة
    Route::post('/tips', [AdminAdviceController::class, 'store'])->name('dashbord.tips.store');  // تخزين النصيحة
    Route::get('/tips/{advice}/edit', [AdminAdviceController::class, 'edit'])->name('dashbord.tips.edit');  // صفحة تعديل النصيحة
    Route::put('/tips/{advice}', [AdminAdviceController::class, 'update'])->name('dashbord.tips.update');  // تحديث النصيحة
    Route::delete('/tips/{advice}', [AdminAdviceController::class, 'destroy'])->name('dashbord.tips.destroy');  // حذف النصيحة

    Route::get('/users', [adminControler::class, 'showUsers'])->name('users.index');

    Route::get('/user_statistics', [adminControler::class, 'User_statistics'])->name('dashbord.User_statistics');
    // Route لعرض صفحة تعديل المستخدم
    Route::get('/users/{id}/edit', [adminControler::class, 'edit'])->name('users.edit');
    // Route لتحديث بيانات المستخدم
    Route::put('/users/{id}', [adminControler::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [adminControler::class, 'destroy'])->name('users.destroy');

    Route::get('/enable-users', [adminControler::class, 'showEnableUsers'])->name('users.enable');
    Route::put('/users/{id}/statusEn', [adminControler::class, 'updateStatusenable'])->name('users.updateStatusenable');
    Route::get('/banned-users', [adminControler::class, 'showBannedUsers'])->name('users.banned');
    Route::put('/users/{id}/statusBn', [adminControler::class, 'updateStatusbanned'])->name('users.updateStatusbanned');

    Route::get('/email-users', [adminControler::class, 'showEmailUsers'])->name('users.email');
    Route::get('/phone-users', [adminControler::class, 'showPhoneUsers'])->name('users.phone');


    Route::post('/mark-as-read',[adminControler::class,'markNotification'])->name('markNotification');
});

require __DIR__.'/admin_auth.php';

});

