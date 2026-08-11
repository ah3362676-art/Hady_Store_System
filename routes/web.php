<?php


use App\Http\Controllers\BackupController;
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


    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    // Category
    Route::resource('categories', CategoryController::class);


    // Brand
    Route::resource('brands', BrandController::class);


    // Unit
    Route::resource('units', UnitController::class);


    // Product
    Route::resource('products', ProductController::class);


    // Supplier
    Route::resource('suppliers', SupplierController::class);


    // Purchase
    Route::resource('purchases', PurchaseController::class);


    // Customer
    Route::resource('customers', CustomerController::class);


    // Statement / Customer
    Route::get(
        '/customers/{customer}/statement',
        [CustomerController::class, 'statement']
    )->name('customers.statement');


    // Sales
    Route::resource('sales', SaleController::class);


    // Customer Payments
    Route::resource('customer-payments', CustomerPaymentController::class)
        ->except('show');


    // Supplier Payments
    Route::resource('supplier-payments', SupplierPaymentController::class)
        ->except('show');


    // Reports
    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');


    // Language
    Route::get('/language/{locale}', function ($locale) {

        if (! in_array($locale, ['en', 'ar'])) {
            abort(404);
        }

        Session::put('locale', $locale);

        App::setLocale($locale);

        return back();

    })->name('language.switch');


    // Print PDF Sale Show
    Route::get(
        '/sales/{sale}/pdf',
        [SaleController::class, 'pdf']
    )->name('sales.pdf');


// Backup

Route::get('/backup', [BackupController::class, 'index'])
    ->name('backup.index');

Route::post('/backup/run', [BackupController::class, 'run'])
    ->name('backup.run');

Route::get('/backup/download/{filename}', [BackupController::class, 'download'])
    ->name('backup.download');

Route::delete('/backup/{filename}', [BackupController::class, 'destroy'])
    ->name('backup.destroy');

Route::post('/backup/restore/{filename}', [BackupController::class, 'restore'])
    ->name('backup.restore');



        });


// Print Cashier Receipt
Route::get(
    '/sales/{sale}/receipt',
    [SaleController::class, 'receipt']
)->name('sales.receipt');


require __DIR__.'/auth.php';

