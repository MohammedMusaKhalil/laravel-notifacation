<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\WhatsappController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/wa', [WhatsappController::class, 'index']);
Route::post('whatsapp', [WhatsAppController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //normal user routes
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('dashboard.notification');

    Route::post('/notifications/toggle', [NotificationController::class, 'toggleNotifications'])->name('notifications.toggle');

    Route::post('/notifications/update-time', [NotificationController::class, 'updateNotificationTime'])->name('notifications.updateTime');

    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
});

Route::get('/auth/google',[SocialiteController::class,'redirectgoogle']);
Route::get('/auth/google/callback',[SocialiteController::class,'callbackgoogle']);

Route::get('/auth/facebook',[SocialiteController::class,'redirectfacebook']);
Route::get('/auth/facebook/callback',[SocialiteController::class,'callbackfacebook']);

Route::get('/auth/apple',[SocialiteController::class,'redirectapple']);
Route::get('/auth/apple/callback',[SocialiteController::class,'callbackapple']);


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
