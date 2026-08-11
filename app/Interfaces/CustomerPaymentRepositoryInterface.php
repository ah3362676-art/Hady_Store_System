<?php

namespace App\Interfaces;

use App\Models\CustomerPayment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CustomerPaymentRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    public function create(array $data): CustomerPayment;

    public function update(CustomerPayment $customerPayment, array $data): bool;

    public function delete(CustomerPayment $customerPayment): bool;
}
