<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\adminControler;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// test
Route::get('/', function(Request $request) {
    // استخراج جميع الباراميترز الموجودة في الطلب
    $params = $request->header('lang');

    // إرجاع الباراميترز كـ JSON للعرض
    return $params;
});

// Public routes
Route::get('/auth/google',[SocialiteController::class,'redirectgoogleapi']);
Route::get('/auth/google/callback',[SocialiteController::class,'callbackgoogleapi']);

Route::get('/auth/facebook',[SocialiteController::class,'redirectfacebookapi']);
Route::get('/auth/facebook/callback',[SocialiteController::class,'callbackfacebookapi']);

Route::get('/auth/apple',[SocialiteController::class,'redirectappleapi']);
Route::get('/auth/apple/callback',[SocialiteController::class,'callbackappleapi']);

// Protected routes (requires authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'editapi']);
    Route::patch('/profile', [ProfileController::class, 'updateapi']);
    Route::delete('/profile', [ProfileController::class, 'destroyapi']);

    // Notifications routes
    Route::get('/notifications', [NotificationController::class, 'indexapi']);
    Route::post('/notifications/toggle', [NotificationController::class, 'toggleNotificationsapi']);
    Route::post('/notifications/update-time', [NotificationController::class, 'updateNotificationTimeapi']);
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsReadapi']);
});

Route::prefix('admin')->name('admin.')->group(function() {
    Route::middleware(['auth:sanctum', 'isAdmin'])->group(function() {
        Route::get('/dashboard', [adminControler::class, 'indexapi'])->name('dashboard');
        // Sending notification to all users
        Route::post('/notifications/send', [NotificationController::class, 'sendToAllUsersapi'])->name('notifications.send');

        // Mark notification as read
        Route::post('/mark-as-read', [adminControler::class, 'markNotificationapi'])->name('markNotification');
    });
});

require __DIR__ . '/admin_auth_api.php';
require __DIR__ . '/auth_api.php';
