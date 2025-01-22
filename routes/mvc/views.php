<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Views\{
    Auth\LoginController,
    Auth\RegisterController,
    Auth\ResetPasswordController,
    Auth\VerifyController,
    ForgotPasswordController,
    ContactController,
    HomeController,
    TourController,
    TransferController,
    WishListController
};

// Frontend Routes Group
Route::group(['prefix' => '', 'as' => 'view.'], function () {

    // Ümumi Səhifələr
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::get('/wish-list', [WishListController::class, 'index'])->name('wishlist');
    Route::get('/about', [\App\Http\Controllers\Views\AboutController::class, 'index'])->name('about');
    Route::get('/privacy-policy', [\App\Http\Controllers\Views\PrivacyPolicyController::class, 'index'])->name('privacy_policy');
    Route::get('/terms-of-use', [\App\Http\Controllers\Views\TermsOfUseController::class, 'index'])->name('terms_of_use');

    // Tours Routes
    Route::group([], function () {
        Route::get('/tours', [TourController::class, 'index'])->name('tours');
        Route::get('/tours/{id}/{slug}', [TourController::class, 'view'])->name('tours.view');
    });

    // Transfers Routes
    Route::group([], function () {
        Route::get('/transfers', [TransferController::class, 'index'])->name('transfers');
        Route::get('/transfers/{id}/{slug}', [TransferController::class, 'view'])->name('transfers.view');
    });

    // Authentication Routes
    Route::group(['prefix' => '', 'as' => 'auth.'], function () {
        // Registration
        Route::get('/register', [RegisterController::class, 'index'])->name('register');
        Route::post('/register', [RegisterController::class, 'register'])->name('register');

        // Login
        Route::get('/login', [LoginController::class, 'index'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login');

        // Email Verification
        Route::get('/verify-email/{token}', [VerifyController::class, 'verify'])->name('verify.email');

        // Forgot Password
        Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('password.forgot');
        Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.send_reset_request');

        // Reset Password
        Route::get('/reset-password/{email}/{code}', [ResetPasswordController::class, 'index'])->name('password.reset');
        Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.reset_password');
    });
});
