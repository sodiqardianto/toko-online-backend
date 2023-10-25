<?php

use App\Http\Controllers\DashboardContoller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGalleryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardContoller::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::get('/dashboard', [DashboardContoller::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('products', ProductController::class);
    Route::get('products/{product}/gallery', [ProductController::class, 'gallery'])->name('products.gallery');
    Route::resource('product-galleries', ProductGalleryController::class)->except(['show', 'edit', 'update']);
    Route::resource('transactions', TransactionController::class);
    Route::get('transactions/{id}/set-status', [TransactionController::class, 'setStatus'])->name('transactions.status');
});

require __DIR__ . '/auth.php';
