<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    if (!auth()->check()) {
        return to_route('login');
    }
    return to_route('home');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', HomeController::class)->name('home');

    Route::get('admin', [AdminController::class, 'index'])->name('admin');
    Route::post('admin/datatable', [AdminController::class, 'datatable'])->name('admin.datatable');
    Route::get('admin/next-code', [AdminController::class, 'nextCode'])->name('admin.next-code');
    Route::post('admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('admin/{id}/update', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('admin/{id}/destroy', [AdminController::class, 'destroy'])->name('admin.destroy');

    Route::get('customer', [CustomerController::class, 'index'])->name('customer');
    Route::post('customer/datatable', [CustomerController::class, 'datatable'])->name('customer.datatable');
    Route::get('customer/next-code', [CustomerController::class, 'nextCode'])->name('customer.next-code');
    Route::post('customer/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('customer/{id}/update', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('customer/{id}/destroy', [CustomerController::class, 'destroy'])->name('customer.destroy');
});
