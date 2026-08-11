<?php

namespace App\Interfaces;

use App\Models\Supplier;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface SupplierRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    public function create(array $data): Supplier;

    public function update(Supplier $supplier, array $data): bool;

    public function delete(Supplier $supplier): bool;
}
