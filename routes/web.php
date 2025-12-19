<?php

use Illuminate\Support\Facades\{Auth, Route};
use App\Livewire\Shipments\{Create as ShipmentsCreate, Edit as ShipmentsEdit, Index as ShipmentsIndex, Show as ShipmentsShow, TrackShipment};
use App\Livewire\FuelMaintenance\{CreateFuel, CreateMaintenance, EditFuel, EditMaintenance, Index as FuelMaintenanceIndex, ShowFuel, ShowMaintenance};
use App\Livewire\Auth\{Login, Register};
use App\Livewire\Dashboard\Index as DashboardIndex;
use App\Livewire\DriverAssignments\Index as DriverAssignmentsIndex;
use App\Livewire\Drivers\{Create as DriversCreate, Edit as DriversEdit, Index as DriversIndex, Show as DriversShow};
use App\Livewire\Vehicles\{Create as VehiclesCreate, Edit as VehiclesEdit, Index as VehiclesIndex, Show as VehiclesShow};

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Guest Routes (Unauthenticated Users Only)
|--------------------------------------------------------------------------

*/
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Logged-in Users Only)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', DashboardIndex::class)->name('dashboard');

    // Shipments Management
    Route::prefix('shipments')->name('shipments.')->group(function () {
        Route::get('/', ShipmentsIndex::class)->name('index');
        Route::get('/create', ShipmentsCreate::class)->name('create');
        Route::get('/{shipment}', ShipmentsShow::class)->name('show');
        Route::get('/{shipment}/edit', ShipmentsEdit::class)->name('edit');
        Route::get('/track/{tracking?}', TrackShipment::class)->name('track');

    });

    // Drivers Management
    Route::prefix('drivers')->name('drivers.')->group(function () {
        Route::get('/', DriversIndex::class)->name('index');
        Route::get('/create', DriversCreate::class)->name('create');
        Route::get('/{driver}', DriversShow::class)->name('show');
        Route::get('/{driver}/edit', DriversEdit::class)->name('edit');
    });

    // Vehicles Management
    Route::prefix('vehicles')->name('vehicles.')->group(function () {
        Route::get('/', VehiclesIndex::class)->name('index');
        Route::get('/create', VehiclesCreate::class)->name('create');
        Route::get('/{vehicle}', VehiclesShow::class)->name('show');
        Route::get('/{vehicle}/edit', VehiclesEdit::class)->name('edit');
    });

    // Driver Assignment
    Route::get('/driver-assignments', DriverAssignmentsIndex::class)->name('driver-assignments.index');

    // Fuel & Maintenance Management
    Route::prefix('fuel-maintenance')->name('fuel-maintenance.')->group(function () {
        Route::get('/', FuelMaintenanceIndex::class)->name('index');

        // Fuel routes
        Route::get('/fuel/create', CreateFuel::class)->name('create-fuel');
        Route::get('/fuel/{fuelRecord}', ShowFuel::class)->name('show-fuel');
        Route::get('/fuel/{fuelRecord}/edit', EditFuel::class)->name('edit-fuel');

        // Maintenance routes
        Route::get('/maintenance/create', CreateMaintenance::class)->name('create-maintenance');
        Route::get('/maintenance/{maintenanceRecord}', ShowMaintenance::class)->name('show-maintenance');
        Route::get('/maintenance/{maintenanceRecord}/edit', EditMaintenance::class)->name('edit-maintenance');
    });

    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});
