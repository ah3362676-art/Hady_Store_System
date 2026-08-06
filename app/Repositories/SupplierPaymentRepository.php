<?php

namespace App\Repositories;

use App\Models\SupplierPayment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Interfaces\SupplierPaymentRepositoryInterface;

class SupplierPaymentRepository implements SupplierPaymentRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return SupplierPayment::with('supplier')
            ->latest()
            ->paginate($perPage);
    }

    public function create(array $data): SupplierPayment
    {
        return SupplierPayment::create($data);
    }

    public function update(SupplierPayment $supplierPayment, array $data): bool
    {
        return $supplierPayment->update($data);
    }

    public function delete(SupplierPayment $supplierPayment): bool
    {
        return $supplierPayment->delete();
    }
}
