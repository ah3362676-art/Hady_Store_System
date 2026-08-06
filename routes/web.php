<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerPaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplierPaymentController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Category
    Route::resource('categories', CategoryController::class);

    // Brand
    Route::resource('brands', BrandController::class);

    // Unit
    Route::resource('units', UnitController::class);

    // Product
    Route::resource('products', ProductController::class);

    // supplier
    Route::resource('suppliers', SupplierController::class);

    //purchase
    Route::resource('purchases', PurchaseController::class);

    //customer
    Route::resource('customers', CustomerController::class);

    //statement/customer
    Route::get(
        '/customers/{customer}/statement',
        [CustomerController::class, 'statement']
    )->name('customers.statement');

    //sales
    Route::resource('sales', SaleController::class);

    //customer-payments
    Route::resource('customer-payments', CustomerPaymentController::class)
        ->except('show');

    //supplier-payments
    Route::resource('supplier-payments', SupplierPaymentController::class)
        ->except('show');

    //report
    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');



    //lang
    Route::get('/language/{locale}', function ($locale) {

        if (! in_array($locale, ['en', 'ar'])) {
            abort(404);
        }

        Session::put('locale', $locale);

        App::setLocale($locale);

        return back();

    })->name('language.switch');







    //print pdf sale show
    Route::get(
        '/sales/{sale}/pdf',
        [SaleController::class, 'pdf']
    )->name('sales.pdf');

});

//print casher
Route::get('/sales/{sale}/receipt', [SaleController::class, 'receipt'])
    ->name('sales.receipt');

require __DIR__.'/auth.php';
