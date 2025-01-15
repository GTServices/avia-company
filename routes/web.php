<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Views\HomeController;
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tours', function () {
    return view('tours');
})->name('tours');

Route::get('/transfers', function () {
    return view('transfers');
})->name('transfers');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
