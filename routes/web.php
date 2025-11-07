<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\{Login, Register};

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', Register::class)->name('rigister');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/', function () {
    return view('welcome');
})->name('home');
