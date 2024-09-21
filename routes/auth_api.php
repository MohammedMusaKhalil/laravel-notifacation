<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('guest')->group(function () {

    Route::post('register', [RegisteredUserController::class, 'storeapi']);

    Route::post('login', [AuthenticatedSessionController::class, 'storeapi']);

    Route::post('forgot-password', [PasswordResetLinkController::class, 'storeapi'])
                ->name('password.email');

    Route::post('reset-password', [NewPasswordController::class, 'storeapi'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'storeapi'])
                ->middleware('throttle:6,1')
                ->name('verification.send');


    Route::post('confirm-password', [ConfirmablePasswordController::class, 'storeapi']);

    Route::put('password', [PasswordController::class, 'updateapi'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroyapi'])
                ->name('logout');
});
