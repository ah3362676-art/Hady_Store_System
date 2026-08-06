<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\SaleItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $salesChart = Sale::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $purchasesChart = Purchase::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $lowStockProducts = Product::whereColumn(
                'quantity',
                '<=',
                'reorder_level'
            )
            ->latest()
            ->take(5)
            ->get();

        $latestSales = Sale::with('customer')
            ->latest()
            ->take(5)
            ->get();

        $latestPurchases = Purchase::with('supplier')
            ->latest()
            ->take(5)
            ->get();

        $topProducts = SaleItem::select(
                'product_id',
                DB::raw('SUM(quantity) as total_quantity')
            )
            ->whereHas('product')
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | المنتجات التي ستنتهي خلال 30 يوم
        |--------------------------------------------------------------------------
        */

$expiringProducts = Product::whereHas('purchaseItems', function ($query) {

    $query->whereBetween(
        'expiry_date',
        [
            now()->format('Y-m-d'),
            now()->addDays(30)->format('Y-m-d')
        ]
    );

})
->with([
    'purchaseItems' => function ($query) {

        $query->whereBetween(
            'expiry_date',
            [
                now()->format('Y-m-d'),
                now()->addDays(30)->format('Y-m-d')
            ]
        )
        ->orderBy('expiry_date');

    }
])
->get();
return view('dashboard', [
            /*
            |--------------------------------------------------------------------------
            | Counters
            |--------------------------------------------------------------------------
            */

            'productsCount'   => Product::count(),
            'categoriesCount' => Category::count(),
            'brandsCount'     => Brand::count(),
            'customersCount'  => Customer::count(),
            'suppliersCount'  => Supplier::count(),
            'purchasesCount'  => Purchase::count(),
            'salesCount'      => Sale::count(),

            /*
            |--------------------------------------------------------------------------
            | Money
            |--------------------------------------------------------------------------
            */

            'salesTotal'     => Sale::sum('total'),
            'purchasesTotal' => Purchase::sum('total'),

            'customerDue' => Customer::sum('balance'),
            'supplierDue' => Supplier::sum('balance'),

            'profit' => Sale::sum('total') - Purchase::sum('total'),

            /*
            |--------------------------------------------------------------------------
            | Charts
            |--------------------------------------------------------------------------
            */

            'salesChart'     => $salesChart,
            'purchasesChart' => $purchasesChart,

            /*
            |--------------------------------------------------------------------------
            | Tables
            |--------------------------------------------------------------------------
            */

            'lowStockProducts' => $lowStockProducts,
            'latestSales'      => $latestSales,
            'latestPurchases'  => $latestPurchases,
            'topProducts'      => $topProducts,

            /*
            |--------------------------------------------------------------------------
            | Expiring Products
            |--------------------------------------------------------------------------
            */

            'expiringProducts' => $expiringProducts,

        ]);
    }
}
