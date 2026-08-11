<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Services\SupplierService;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;

class SupplierController extends Controller
{
    public function __construct(
        protected SupplierService $supplierService
    ) {
    }

    public function index()
    {
        $suppliers = $this->supplierService->paginate();

        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(StoreSupplierRequest $request)
    {
        $this->supplierService->create($request->validated());

        return redirect()
            ->route('suppliers.index')
            ->with('success', __('messages.supplier_created_successfully'));
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $this->supplierService->update($supplier, $request->validated());

        return redirect()
            ->route('suppliers.index')
            ->with('success', __('messages.supplier_updated_successfully'));
    }

    public function destroy(Supplier $supplier)
    {
        $this->supplierService->delete($supplier);

        return redirect()
            ->route('suppliers.index')
            ->with('success', __('messages.supplier_deleted_successfully'));
    }
}
