<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\PasswordConfirmationController;
use App\Http\Controllers\Auth\PasswordForgottenController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\ProfilePasswordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Auth Routes
|--------------------------------------------------------------------------
|
| This file is for defining the HTTP web routes relating to authentication
| for the application.
|
*/

/** AuthenticatedSessionController Routes */
Route::controller(AuthenticatedSessionController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('logout', 'edit')->name('logout.edit');
        Route::post('logout', 'destroy')->name('logout');
    });

    Route::middleware('guest')->group(function () {
        Route::get('login', 'create')->name('login');
        Route::post('login', 'store')->name('login.store');
    });
});

/** EmailVerificationController Routes */
Route::controller(EmailVerificationController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        /**
         * Email verification routes must have be named as follows to work with the
         * relevant out-the-box Laravel middleware:
         * verification.notice
         * verification.send
         * verification.verify
         * See [Laravel User Verification Docs](https://laravel.com/docs/10.x/verification)
         */
        Route::get('verify-email', 'show')->name('verification.notice');

        Route::post('email/verification-notification', 'store')
            ->middleware('throttle:6,1')
            ->name('verification.send');

        Route::get('verify-email/{id}/{hash}', 'edit')
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');
    });
});

/** ForgottenPasswordController Routes */
Route::controller(PasswordConfirmationController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('confirm-password', 'show')->name('password.confirm');
        Route::post('confirm-password', 'store')->name('password.confirm.store');
    });
});

/** ForgottenPasswordController Routes */
Route::controller(PasswordForgottenController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('forgot-password', 'create')->name('password.request');
        Route::post('forgot-password', 'store')->name('password.email');
        Route::get('reset-password/{token}', 'edit')->name('password.reset');
        Route::post('reset-password', 'update')->name('password.store');
    });
});

/** ProfileController Routes */
Route::controller(ProfileController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
        Route::get('profile', 'edit')->name('profile.edit');
        Route::patch('profile', 'update')->name('profile.update');
        Route::delete('profile', 'destroy')->name('profile.destroy');
    });

    Route::middleware('guest')->group(function () {
        Route::get('register', 'create')->name('register');
        Route::post('register', 'store')->name('register.store');
    });
});

/** ProfilePasswordController Routes */
Route::controller(ProfilePasswordController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::patch('profile/password', 'update')->name('profile.password.update');
    });
});
