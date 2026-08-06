<?php

namespace App\Repositories;

use App\Models\CustomerPayment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Interfaces\CustomerPaymentRepositoryInterface;

class CustomerPaymentRepository implements CustomerPaymentRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return CustomerPayment::with('customer')
            ->latest()
            ->paginate($perPage);
    }

    public function create(array $data): CustomerPayment
    {
        return CustomerPayment::create($data);
    }

    public function update(CustomerPayment $customerPayment, array $data): bool
    {
        return $customerPayment->update($data);
    }

    public function delete(CustomerPayment $customerPayment): bool
    {
        return $customerPayment->delete();
    }
}
