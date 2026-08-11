<?php

namespace App\Interfaces;

use App\Models\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CustomerRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    public function create(array $data): Customer;

    public function update(Customer $customer, array $data): bool;

    public function delete(Customer $customer): bool;
}
