<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Services\CustomerService;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Services\StatementService;

class CustomerController extends Controller
{
    public function __construct(
        protected CustomerService $customerService,
         protected StatementService $StatementService


    ) {
    }

    public function index()
    {
        $customers = $this->customerService->paginate();

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(StoreCustomerRequest $request)
    {
        $this->customerService->create(
            $request->validated()
        );

        return redirect()
            ->route('customers.index')
            ->with('success', __('messages.customer_created_successfully'));
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(
        UpdateCustomerRequest $request,
        Customer $customer
    ) {
        $this->customerService->update(
            $customer,
            $request->validated()
        );

        return redirect()
            ->route('customers.index')
            ->with('success', __('messages.customer_updated_successfully'));
    }

    public function statement(Customer $customer)
{
$statement = $this->StatementService
    ->customerStatement($customer, request()->all());

    return view('customers.statement', compact(
        'customer',
        'statement'
    ));
}
    public function destroy(Customer $customer)
    {
        $this->customerService->delete($customer);

        return redirect()
            ->route('customers.index')
            ->with('success', __('messages.customer_deleted_successfully'));
    }
}
