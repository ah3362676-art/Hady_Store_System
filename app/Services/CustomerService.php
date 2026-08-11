<?php

namespace App\Services;

use App\Models\Customer;
use App\Interfaces\CustomerRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CustomerService
{
    public function __construct(
        protected CustomerRepositoryInterface $customerRepository
    ) {
    }

    public function paginate(): LengthAwarePaginator
    {
        return $this->customerRepository->paginate();
    }

    public function create(array $data): Customer
    {
        return $this->customerRepository->create($data);
    }

    public function update(Customer $customer, array $data): bool
    {
        return $this->customerRepository->update($customer, $data);
    }

    public function delete(Customer $customer): bool
    {
        return $this->customerRepository->delete($customer);
    }
}
