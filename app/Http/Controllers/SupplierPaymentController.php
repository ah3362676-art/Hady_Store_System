<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplierPaymentRequest;
use App\Http\Requests\UpdateSupplierPaymentRequest;
use App\Models\Supplier;
use App\Models\SupplierPayment;
use App\Services\SupplierPaymentService;

class SupplierPaymentController extends Controller
{
    public function __construct(
        protected SupplierPaymentService $supplierPaymentService
    ) {
    }

    public function index()
    {
        $supplierPayments = $this->supplierPaymentService->paginate();

        return view('supplier-payments.index', compact('supplierPayments'));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('name')->get();

        return view('supplier-payments.create', compact('suppliers'));
    }

    public function store(StoreSupplierPaymentRequest $request)
    {
        $this->supplierPaymentService->create($request->validated());

        return redirect()
            ->route('supplier-payments.index')
            ->with('success', __('messages.payment_created_successfully'));
    }

    public function edit(SupplierPayment $supplierPayment)
    {
        $suppliers = Supplier::orderBy('name')->get();

        return view(
            'supplier-payments.edit',
            compact('supplierPayment', 'suppliers')
        );
    }

    public function update(
        UpdateSupplierPaymentRequest $request,
        SupplierPayment $supplierPayment
    ) {
        $this->supplierPaymentService->update(
            $supplierPayment,
            $request->validated()
        );

        return redirect()
            ->route('supplier-payments.index')
            ->with('success', __('messages.payment_updated_successfully'));
    }

    public function destroy(SupplierPayment $supplierPayment)
    {
        $this->supplierPaymentService->delete($supplierPayment);

        return redirect()
            ->route('supplier-payments.index')
            ->with('success', __('messages.payment_deleted_successfully'));
    }
}
