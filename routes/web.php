<?php

use App\Http\Livewire\UserTable;
use App\Http\Livewire\ProductTable;
use App\Http\Livewire\ProviderTable;
use App\Http\Livewire\ReportTable;
use App\Http\Livewire\VehicleTable;
use App\Http\Livewire\CustomerTable;
use App\Http\Livewire\Billing;
use App\Http\Livewire\Reporting;
use App\Http\Livewire\VehicleView;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/forgot-password-offline', function () {
    return view('auth.forgot-password-offline');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
Route::get('/Users', UserTable::class)->name('users.index');
Route::get('/Products', ProductTable::class)->name('products.index');
Route::get('/Providers', ProviderTable::class)->name('providers.index');
    Route::get('providers/export/', [ProvidersController::class, 'export']);
    Route::get('ProvidersExportPdf/{id}', [ProviderTable::class, 'pdf'])->name('ProvidersExportPdf.pdf');
Route::get('/Reports', ReportTable::class)->name('reports.index');
Route::get('/Vehicles', VehicleTable::class)->name('vehicles.index');
Route::get('vehiclePdf/{id}', [VehicleTable::class, 'pdf'])->name('vehicles.pdf');
Route::get('/Billing', Billing::class)->name('billing.index');
Route::get('/Reporting', Reporting::class)->name('reporting.index');
Route::get('BillingPdf/{id}', [Billing::class, 'pdf'])->name('billing.pdf');
Route::get('users/export/', [UsersController::class, 'export']);
Route::get('pdf/{id}', [UserTable::class, 'pdf'])->name('users.pdf');
Route::get('/Products', ProductTable::class)->name('products.index');
Route::get('products/export/', [ProductsController::class, 'export']);
Route::get('productPdf/{id}', [ProductTable::class, 'pdf'])->name('products.pdf');
Route::get('/Customers', CustomerTable::class)->name('customers.index');
Route::get('customers/export/', [CustomersController::class, 'export']);
Route::get('customerPdf/{id}', [CustomerTable::class, 'pdf'])->name('customers.pdf');
});
 

