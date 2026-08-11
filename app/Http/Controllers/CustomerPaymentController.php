<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerPaymentRequest;
use App\Http\Requests\UpdateCustomerPaymentRequest;
use App\Models\Customer;
use App\Models\CustomerPayment;
use App\Services\CustomerPaymentService;

class CustomerPaymentController extends Controller
{
    public function __construct(
        protected CustomerPaymentService $customerPaymentService
    ) {
    }

    public function index()
    {
        $customerPayments = $this->customerPaymentService->paginate();

        return view('customer-payments.index', compact('customerPayments'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();

        return view('customer-payments.create', compact('customers'));
    }

    public function store(StoreCustomerPaymentRequest $request)
    {
        $this->customerPaymentService->create($request->validated());

        return redirect()
            ->route('customer-payments.index')
            ->with('success', __('messages.customer_payment_created_successfully'));
    }

    public function edit(CustomerPayment $customerPayment)
    {
        $customers = Customer::orderBy('name')->get();

        return view(
            'customer-payments.edit',
            compact('customerPayment', 'customers')
        );
    }

    public function update(
        UpdateCustomerPaymentRequest $request,
        CustomerPayment $customerPayment
    ) {
        $this->customerPaymentService->update(
            $customerPayment,
            $request->validated()
        );

        return redirect()
            ->route('customer-payments.index')
            ->with('success', __('messages.customer_payment_updated_successfully'));
    }

    public function destroy(CustomerPayment $customerPayment)
    {
        $this->customerPaymentService->delete($customerPayment);

        return redirect()
            ->route('customer-payments.index')
            ->with('success', __('messages.customer_payment_deleted_successfully'));
    }
}
