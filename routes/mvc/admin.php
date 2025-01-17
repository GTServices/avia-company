<?php
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/languages', \App\Http\Controllers\Admin\LanguageController::class)->except(['show']);
    Route::resource('/translates', \App\Http\Controllers\Admin\TranslateController::class)->except(['show']);
});
