<?php
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => [ 'admin']], function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/languages', \App\Http\Controllers\Admin\LanguageController::class)->except(['show']);
    Route::resource('/translates', \App\Http\Controllers\Admin\TranslateController::class)->except(['show']);
    Route::resource('/tours', \App\Http\Controllers\Admin\TourController::class)->except(['show']);
    Route::resource('/cities', \App\Http\Controllers\Admin\CityController::class)->except(['show']);
    Route::resource('/airports', \App\Http\Controllers\Admin\AirportController::class)->except(['show']);
    Route::resource('/transfers', \App\Http\Controllers\Admin\TransferController::class)->except(['show']);
    Route::resource('/user_rules', \App\Http\Controllers\Admin\UserRuleController::class)->except(['show']);
    Route::resource('/privacy_policies', \App\Http\Controllers\Admin\PrivacyPolicyController::class)->except(['show']);
    Route::resource('/about_us', \App\Http\Controllers\Admin\AboutUsController::class)
        ->parameters(['about_us' => 'aboutUs'])
        ->except(['show']);
    Route::post('/logout', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');
});

// Login route without middleware
Route::get('/admin/login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'authenticate'])->name('admin.login');
