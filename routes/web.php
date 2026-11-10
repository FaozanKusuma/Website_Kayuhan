<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminMenuController;

Route::get('/', function () {
    return view('public.index');
});

// Mendaftarkan rute dengan nama 'dashboard' untuk pengalihan setelah login
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Mendaftarkan rute alternatif 'admin.dashboard' untuk navigasi internal
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

// Rute Manajemen Menu
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/menus', [AdminMenuController::class, 'index'])->name('menus.index');
    Route::get('/menus/create', [AdminMenuController::class, 'create'])->name('menus.create');
    Route::post('/menus', [AdminMenuController::class, 'store'])->name('menus.store');
});

require __DIR__.'/auth.php';
