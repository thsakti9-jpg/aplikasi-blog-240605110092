<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriArtikelController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\BlogController;

// Public Blog Routes (No Auth Required)
Route::get('/', [BlogController::class, 'index'])->name('blog.index');
Route::get('/artikel/{id}', [BlogController::class, 'show'])->name('blog.show')->whereNumber('id');

// Admin Routes (Protected by auth middleware)
Route::middleware('auth')->group(function () {
    Route::resource('artikel', ArtikelController::class)->except(['show']);
    Route::resource('penulis', PenulisController::class)->except(['show']);
    
    // Route dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Route kategori
    Route::resource('kategori', KategoriArtikelController::class)->except(['show']);
});

// Route halaman login
Route::get('/login', [LoginController::class, 'index'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [LoginController::class, 'proses'])
    ->name('login.proses')
    ->middleware('guest');

// Route logout
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');