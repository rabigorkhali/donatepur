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

Route::prefix('mysuperuser')->middleware(['guest', 'throttle:60,1'])->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('superuser.register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('superuser.login');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('superuser.login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('superuser.password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('superuser.password.email');

    Route::get('verify-email/{token}/{email}', [PasswordResetLinkController::class, 'verifyEmail'])
        ->name('superuser.public.user.verify.email');
    // Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    //     ->name('superuser.password.reset');
    // Route::post('reset-password', [NewPasswordController::class, 'store'])
    //     ->name('superuser.password.store');

    Route::post('reset-password', [PasswordResetLinkController::class, 'storeResetForm'])
        ->name('superuser.password.store');
    Route::get('reset-password/{token}', [PasswordResetLinkController::class, 'createResetForm'])
        ->name('superuser.password.reset');
});

Route::group(['prefix' => 'mysuperuser/profile',], function () {
    Route::middleware('frontend_users')->group(function () {
        Route::get('verify-email', EmailVerificationPromptController::class)
            ->name('superuser.verification.notice');

        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('superuser.verification.verify');

        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('superuser.verification.send');

        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
            ->name('superuser.password.confirm');

        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::put('change-password', [PasswordController::class, 'update'])->name('superuser.password.update');
        Route::get('change-password', [PasswordController::class, 'changePassword'])->name('superuser.password.change');

        Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('superuser.logout');
    });
});
