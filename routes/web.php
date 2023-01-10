<?php

use App\Http\Livewire\UserTable;
use App\Http\Livewire\ProductTable;
use App\Http\Livewire\ProviderTable;
use App\Http\Livewire\ReportTable;
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
Route::get('/Reports', ReportTable::class)->name('reports.index');
Route::get('users/export/', [UsersController::class, 'export']);
Route::get('pdf/{id}', [UserTable::class, 'pdf'])->name('users.pdf');
});
 

