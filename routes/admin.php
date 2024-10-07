<?php

use App\Http\Controllers\adminControler;
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


    Route::get('/users', [adminControler::class, 'showUsers'])->name('users.index');
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

