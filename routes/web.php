<?php

use Illuminate\Support\Facades\{Auth, Route};
use App\Livewire\Auth\{Login, Register};
use App\Livewire\Dashboard\Index as DashboardIndex;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
| Routes accessible to everyone (no authentication required)
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Guest Routes (Unauthenticated Users Only)
|--------------------------------------------------------------------------
| These routes are only accessible when user is NOT logged in
| If logged in user tries to access, they'll be redirected to dashboard
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Logged-in Users Only)
|--------------------------------------------------------------------------
| These routes require authentication
| If guest tries to access, they'll be redirected to login
*/
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', DashboardIndex::class)->name('dashboard');

    // Shipments Management
    Route::middleware('auth')->prefix('shipments')->name('shipments.')->group(function () {
        Route::get('/', \App\Livewire\Shipments\Index::class)->name('index');
        Route::get('/create', \App\Livewire\Shipments\Create::class)->name('create');
        Route::get('/{shipment}', \App\Livewire\Shipments\Show::class)->name('show');
        Route::get('/{shipment}/edit', \App\Livewire\Shipments\Edit::class)->name('edit');
    });

    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');

});
