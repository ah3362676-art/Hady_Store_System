<?php

namespace App\Services;

use App\Models\Supplier;
use App\Interfaces\SupplierRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SupplierService
{
    public function __construct(
        protected SupplierRepositoryInterface $supplierRepository
    ) {
    }

    public function paginate(): LengthAwarePaginator
    {
        return $this->supplierRepository->paginate();
    }

    public function create(array $data): Supplier
    {
        return $this->supplierRepository->create($data);
    }

    public function update(Supplier $supplier, array $data): bool
    {
        return $this->supplierRepository->update($supplier, $data);
    }

    public function delete(Supplier $supplier): bool
    {
        return $this->supplierRepository->delete($supplier);
    }
}
