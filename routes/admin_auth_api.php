<?php

use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\AdminAuth\ConfirmablePasswordController;
use App\Http\Controllers\AdminAuth\EmailVerificationNotificationController;
use App\Http\Controllers\AdminAuth\EmailVerificationPromptController;
use App\Http\Controllers\AdminAuth\NewPasswordController;
use App\Http\Controllers\AdminAuth\PasswordController;
use App\Http\Controllers\AdminAuth\PasswordResetLinkController;
use App\Http\Controllers\AdminAuth\RegisteredUserController;
use App\Http\Controllers\AdminAuth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin_Auth API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for admin authentication.
| These routes are loaded by the RouteServiceProvider within a group
| assigned to the "api" middleware group.
|
*/

Route::middleware('guest:admin')->group(function () {
    Route::post('admin_register', [RegisteredUserController::class, 'storeapi'])->name('register');
    Route::post('admin_login', [AuthenticatedSessionController::class, 'storeapi'])->name('login');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'storeapi'])->name('password.email');
    Route::post('reset-password', [NewPasswordController::class, 'storeapi'])->name('password.store');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invokeapi'])->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invokeapi'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'storeapi'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'storeapi'])->name('password.confirm');
    Route::put('password', [PasswordController::class, 'updateapi'])->name('password.update');
    Route::post('admin_logout', [AuthenticatedSessionController::class, 'destroyapi'])->name('logout');
});
