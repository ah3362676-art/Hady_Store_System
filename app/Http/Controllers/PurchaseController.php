<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Services\PurchaseService;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;

class PurchaseController extends Controller
{
    public function __construct(
        protected PurchaseService $purchaseService
    ) {
    }

    public function index()
    {
        $purchases = $this->purchaseService->paginate();
        $products = Product::where('is_active', true)->get();

        return view('purchases.index', compact('purchases', 'products'));
    }

    public function create()
    {
        $products = Product::where('is_active', true)->get();
        $suppliers = Supplier::where('is_active', true)->get();

        return view('purchases.create', compact('suppliers', 'products'));
    }

    public function store(StorePurchaseRequest $request)
    {
        $this->purchaseService->create($request->validated());

        return redirect()
            ->route('purchases.index')
            ->with('success', __('messages.purchase_created_successfully'));
    }

    public function show(Purchase $purchase)
    {
        return view('purchases.show', compact('purchase'));
    }

    public function edit(Purchase $purchase)
    {
        $suppliers = Supplier::where('is_active', true)->get();
        $products = Product::where('is_active', true)->get();

        $purchase->load('items.product');

        return view('purchases.edit', compact('purchase', 'suppliers', 'products'));
    }

    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        $this->purchaseService->update(
            $purchase,
            $request->validated()
        );

        return redirect()
            ->route('purchases.index')
            ->with('success', __('messages.purchase_updated_successfully'));
    }

    public function destroy(Purchase $purchase)
    {
        $this->purchaseService->delete($purchase);

        return redirect()
            ->route('purchases.index')
            ->with('success', __('messages.purchase_deleted_successfully'));
    }
}
