<?php

namespace App\Interfaces;

use App\Models\SupplierPayment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface SupplierPaymentRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    public function create(array $data): SupplierPayment;

    public function update(SupplierPayment $supplierPayment, array $data): bool;

    public function delete(SupplierPayment $supplierPayment): bool;
}
