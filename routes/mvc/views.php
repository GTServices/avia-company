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
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Localized Routes
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    // Frontend Routes Group
    Route::group(['prefix' => '', 'as' => 'view.'], function () {

        // General Pages
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get(__('contact'), [ContactController::class, 'index'])->name('contact');
        Route::get(__('wish_list'), [WishListController::class, 'index'])->name('wishlist');
        Route::get(__('about'), [\App\Http\Controllers\Views\AboutController::class, 'index'])->name('about');
        Route::get(__('privacy_policy'), [\App\Http\Controllers\Views\PrivacyPolicyController::class, 'index'])->name('privacy_policy');
        Route::get(__('terms_of_use'), [\App\Http\Controllers\Views\TermsOfUseController::class, 'index'])->name('terms_of_use');
        Route::get(__('logout'), [\App\Http\Controllers\Views\LogoutController::class, 'logout'])->name('auth.logout');

        // Tours Routes
        Route::group([], function () {
            Route::get(__('tours'), [TourController::class, 'index'])->name('tours');
            Route::get(__('tour_details') . '/{id}/{slug}', [TourController::class, 'view'])->name('tours.view');
        });

        // Transfers Routes
        Route::group([], function () {
            Route::get(__('transfers'), [TransferController::class, 'index'])->name('transfers');
            Route::get(__('transfer_details') . '/{id}/{slug}', [TransferController::class, 'view'])->name('transfers.view');
        });

        // Authentication Routes
        Route::group(['prefix' => '', 'as' => 'auth.'], function () {
            // Registration
            Route::get(__('register'), [RegisterController::class, 'index'])->name('register');
            Route::post(__('register'), [RegisterController::class, 'register'])->name('register');

            // Login
            Route::get(__('login'), [LoginController::class, 'index'])->name('login');
            Route::post(__('login'), [LoginController::class, 'login'])->name('login');

            // Email Verification
            Route::get(__('verify_email') . '/{token}', [VerifyController::class, 'verify'])->name('verify.email');

            // Forgot Password
            Route::get(__('forgot_password'), [ForgotPasswordController::class, 'index'])->name('password.forgot');
            Route::post(__('forgot_password'), [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.send_reset_request');

            // Reset Password
            Route::get(__('reset_password') . '/{email}/{code}', [ResetPasswordController::class, 'index'])->name('password.reset');
            Route::post(__('reset_password'), [ResetPasswordController::class, 'reset'])->name('password.reset_password');
        });
    });
});
