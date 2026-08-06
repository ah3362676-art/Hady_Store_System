<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\CustomerPayment;
use Illuminate\Support\Facades\DB;
use App\Interfaces\CustomerPaymentRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Traits\GeneratesNumbers;

class CustomerPaymentService
{
    use GeneratesNumbers;
    public function __construct(
        protected CustomerPaymentRepositoryInterface $customerPaymentRepository
    ) {
    }

    public function paginate(): LengthAwarePaginator
    {
        return $this->customerPaymentRepository->paginate();
    }

    public function create(array $data): CustomerPayment
    {
        return DB::transaction(function () use ($data) {
            $data['receipt_number'] = $this->generateNumber(
    'CPY',
    CustomerPayment::class,
    'receipt_number'
);

            $payment = $this->customerPaymentRepository->create([

                'customer_id'    => $data['customer_id'],
                'receipt_number' => $data['receipt_number'],
                'payment_date'   => $data['payment_date'],
                'amount'         => $data['amount'],
                'payment_method' => $data['payment_method'],
                'notes'          => $data['notes'] ?? null,

            ]);

            Customer::findOrFail($data['customer_id'])
                ->decrement('balance', $data['amount']);

            return $payment;
        });
    }

    public function update(CustomerPayment $customerPayment, array $data): bool
    {
        return DB::transaction(function () use ($customerPayment, $data) {

            Customer::findOrFail($customerPayment->customer_id)
                ->increment('balance', $customerPayment->amount);

            $this->customerPaymentRepository->update($customerPayment, [

                'customer_id'    => $data['customer_id'],
                'receipt_number' => $customerPayment->receipt_number,
                'payment_date'   => $data['payment_date'],
                'amount'         => $data['amount'],
                'payment_method' => $data['payment_method'],
                'notes'          => $data['notes'] ?? null,

            ]);

            Customer::findOrFail($data['customer_id'])
                ->decrement('balance', $data['amount']);

            return true;
        });
    }

    public function delete(CustomerPayment $customerPayment): bool
    {
        return DB::transaction(function () use ($customerPayment) {

            Customer::findOrFail($customerPayment->customer_id)
                ->increment('balance', $customerPayment->amount);

            return $this->customerPaymentRepository
                ->delete($customerPayment);

        });
    }
}
