<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'supplier'], function() {
    
    Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('supplier.register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('supplier.login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('supplier.password.request');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('supplier.password.email');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('supplier.password.reset');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('supplier.password.update');

    Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
    ->middleware('auth')
    ->name('supplier.verification.notice');

    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('supplier.verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('supplier.verification.send');

    Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->middleware('auth')
    ->name('supplier.password.confirm');

    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
    ->middleware('auth');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('supplier.logout');

});

Route::get('/get-cities-by-state', [RegisteredUserController::class, 'getCitiesByState'])
    ->middleware('guest')
    ->name('supplier.cities');