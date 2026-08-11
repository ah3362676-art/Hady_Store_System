<?php

namespace App\Interfaces;

use App\Models\Purchase;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PurchaseRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    public function create(array $data): Purchase;

    public function update(Purchase $purchase, array $data): bool;

    public function loadItems(Purchase $purchase): Purchase;

    public function delete(Purchase $purchase): bool;
}
