<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Report\AdminController as ReportAdminController;
use App\Http\Controllers\Report\CustomerController as ReportCustomerController;
use App\Http\Controllers\Report\ProductController as ReportProductController;
use App\Http\Controllers\Report\SaleController as ReportSaleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
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

    Route::get('master/admin', [AdminController::class, 'index'])->name('master.admin');
    Route::post('master/admin/datatable', [AdminController::class, 'datatable'])->name('master.admin.datatable');
    Route::get('master/admin/next-code', [AdminController::class, 'nextCode'])->name('master.admin.next-code');
    Route::post('master/admin/store', [AdminController::class, 'store'])->name('master.admin.store');
    Route::get('master/admin/{id}/edit', [AdminController::class, 'edit'])->name('master.admin.edit');
    Route::post('master/admin/{id}/update', [AdminController::class, 'update'])->name('master.admin.update');
    Route::delete('master/admin/{id}/destroy', [AdminController::class, 'destroy'])->name('master.admin.destroy');

    Route::get('master/customer', [CustomerController::class, 'index'])->name('master.customer');
    Route::post('master/customer/datatable', [CustomerController::class, 'datatable'])->name('master.customer.datatable');
    Route::get('master/customer/next-code', [CustomerController::class, 'nextCode'])->name('master.customer.next-code');
    Route::post('master/customer/store', [CustomerController::class, 'store'])->name('master.customer.store');
    Route::get('master/customer/{id}/edit', [CustomerController::class, 'edit'])->name('master.customer.edit');
    Route::post('master/customer/{id}/update', [CustomerController::class, 'update'])->name('master.customer.update');
    Route::delete('master/customer/{id}/destroy', [CustomerController::class, 'destroy'])->name('master.customer.destroy');

    Route::get('master/supplier', [SupplierController::class, 'index'])->name('master.supplier');
    Route::post('master/supplier/datatable', [SupplierController::class, 'datatable'])->name('master.supplier.datatable');
    Route::get('master/supplier/next-code', [SupplierController::class, 'nextCode'])->name('master.supplier.next-code');
    Route::post('master/supplier/store', [SupplierController::class, 'store'])->name('master.supplier.store');
    Route::get('master/supplier/{id}/edit', [SupplierController::class, 'edit'])->name('master.supplier.edit');
    Route::post('master/supplier/{id}/update', [SupplierController::class, 'update'])->name('master.supplier.update');
    Route::delete('master/supplier/{id}/destroy', [SupplierController::class, 'destroy'])->name('master.supplier.destroy');

    Route::get('master/product', [ProductController::class, 'index'])->name('master.product');
    Route::post('master/product/datatable', [ProductController::class, 'datatable'])->name('master.product.datatable');
    Route::get('master/product/next-code', [ProductController::class, 'nextCode'])->name('master.product.next-code');
    Route::post('master/product/store', [ProductController::class, 'store'])->name('master.product.store');
    Route::get('master/product/{id}/edit', [ProductController::class, 'edit'])->name('master.product.edit');
    Route::post('master/product/{id}/update', [ProductController::class, 'update'])->name('master.product.update');
    Route::delete('master/product/{id}/destroy', [ProductController::class, 'destroy'])->name('master.product.destroy');

    Route::get('sale', [SaleController::class, 'index'])->name('sale');
    Route::post('sale/datatable', [SaleController::class, 'datatable'])->name('sale.datatable');

    Route::get('transaction', [TransactionController::class, 'index'])->name('transaction');
    Route::post('transaction/datatable', [TransactionController::class, 'datatable'])->name('transaction.datatable');
    Route::post('transaction/store', [TransactionController::class, 'store'])->name('transaction.store');
    Route::post('transaction/cart/store', [TransactionController::class, 'addToCart'])->name('transaction.cart.store');
    Route::get('transaction/product/{code}/{id}', [TransactionController::class, 'product'])->name('transaction.product');
    Route::get('transaction/cart/{id}/edit', [TransactionController::class, 'editCart'])->name('transaction.cart.edit');
    Route::post('transaction/cart/{id}/update', [TransactionController::class, 'updateCart'])->name('transaction.cart.update');
    Route::delete('transaction/cart/{id}/destroy', [TransactionController::class, 'destroyCart'])->name('transaction.cart.destroy');

    Route::get('report/admin/pdf', ReportAdminController::class)->name('report.admin.pdf');
    Route::get('report/customer/pdf', ReportCustomerController::class)->name('report.customer.pdf');
    Route::get('report/product/pdf', ReportProductController::class)->name('report.product.pdf');
    Route::get('report/sale', [ReportSaleController::class, 'index'])->name('report.sale');
    Route::get('report/sale/export', [ReportSaleController::class, 'export'])->name('report.sale.export');
    Route::get('report/sale/export-by-period', [ReportSaleController::class, 'exportByPeriod'])->name('report.sale.export-by-period');
});
