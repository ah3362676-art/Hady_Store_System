<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use App\Services\SaleService;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{
    public function __construct(
        protected SaleService $saleService
    ) {
    }

    public function index(Request $request)
    {
        $sales = $this->saleService->paginate($request->all());
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $customers = Customer::where('is_active', true)->get();

        $products = Product::where('is_active', true)->get();

        return view('sales.create', compact(
            'customers',
            'products'
        ));
    }

    public function store(StoreSaleRequest $request )
    {
       $sale = $this->saleService->create(
            $request->validated()
        );

        // return redirect()
        //     ->route('sales.index')
        //     ->with('success', __('messages.sale_created_successfully'));
        return redirect()->route('sales.receipt', $sale);
    }

    public function show(Sale $sale)
    {
        $sale->load([
            'customer',
            'items.product',
        ]);

        return view('sales.show', compact('sale'));
    }

    public function edit(Sale $sale)
    {
        $sale->load('items');

        $customers = Customer::where('is_active', true)->get();

        $products = Product::where('is_active', true)->get();

        return view('sales.edit', compact(
            'sale',
            'customers',
            'products'
        ));
    }

    public function update(
        UpdateSaleRequest $request,
        Sale $sale
    ) {
        $this->saleService->update(
            $sale,
            $request->validated()
        );

        return redirect()
            ->route('sales.index')
            ->with('success', __('messages.sale_updated_successfully'));
    }

    public function pdf(Sale $sale)
{
    $sale->load([
        'customer',
        'items.product',
    ]);

    $pdf = Pdf::loadView('sales.pdf', [
        'sale' => $sale,
    ]);

    $pdf->setPaper('a4', 'portrait');

    return $pdf->download(
        'Sale-' . $sale->invoice_number . '.pdf'
    );
}

public function receipt(Sale $sale)
{
    $sale->load([
        'customer',
        'items.product',
    ]);

    return view('sales.receipt', compact('sale'));
}

    public function destroy(Sale $sale)
    {
        $this->saleService->delete($sale);

        return redirect()
            ->route('sales.index')
            ->with('success', __('messages.sale_deleted_successfully'));
    }
}
