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
    
    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
    
    // Add more authenticated routes here as you build features
    // Route::get('/shipments', ShipmentList::class)->name('shipments');
    // Route::get('/fleet', FleetManagement::class)->name('fleet');
    // Route::get('/reports', ReportsList::class)->name('reports');
    // Route::get('/settings', Settings::class)->name('settings');
    
});