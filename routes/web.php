<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Views\HomeController;
use App\Http\Controllers\Views\ContactController;
use App\Http\Controllers\Views\TransferController;
use App\Http\Controllers\Views\TourController;
use App\Http\Controllers\Views\WishListController;
use App\Http\Controllers\Views\RegisterController;
use App\Http\Controllers\Views\LoginController;
use App\Http\Controllers\Views\VerifyController;
Route::get('/', [HomeController::class, 'index'])->name('view.home');
Route::get('/tours', [TourController::class, 'index'])->name('view.tours');
Route::get('/tours/one', [TourController::class, 'view'])->name('view.tours.view');


Route::get('/transfers', [TransferController::class, 'index'])->name('view.transfers');
Route::get('/transfers/one', [TransferController::class, 'view'])->name('view.transfers.view');


Route::get('/wish-list', [WishListController::class, 'index'])->name('view.wishlist');
Route::get('/contact', [ContactController::class, 'index'])->name('view.contact');


Route::get('/register', [RegisterController::class, 'index'])->name('view.auth.register');
Route::post('/register', [RegisterController::class, 'register'])->name('view.auth.register');


Route::get('/login', [LoginController::class, 'index'])->name('view.auth.login');
Route::post('/login', [LoginController::class, 'login'])->name('view.auth.login');

Route::get('/verify-email/{token}', [VerifyController::class, 'verify'])->name('view.auth.verify.email');
