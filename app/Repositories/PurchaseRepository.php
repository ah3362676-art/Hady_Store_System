<?php

namespace App\Repositories;
use App\Models\Purchase;
use App\Interfaces\PurchaseRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PurchaseRepository implements PurchaseRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Purchase::with('supplier')
            ->latest()
            ->paginate($perPage);
    }

    public function create(array $data): Purchase
    {
        return Purchase::create($data);
    }

    public function loadItems(Purchase $purchase): Purchase
{
    return $purchase->load('items');
}
    public function update(Purchase $purchase, array $data): bool
    {
        return $purchase->update($data);
    }

    public function delete(Purchase $purchase): bool
    {
        return $purchase->delete();
    }
}
