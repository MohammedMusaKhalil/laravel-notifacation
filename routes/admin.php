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
   // Route::view('/dashbord','admin.dashbord')->name('dashbord');
    Route::get('/dashbord',[adminControler::class,'index'])->name('dashbord');
    Route::get('/dashbord/send',[adminControler::class,'send'])->name('dashbord.send');
    Route::post('/notifications/send', [NotificationController::class, 'sendToAllUsers'])->name('notifications.send');
    Route::post('/mark-as-read',[adminControler::class,'markNotification'])->name('markNotification');
});

require __DIR__.'/admin_auth.php';

});

