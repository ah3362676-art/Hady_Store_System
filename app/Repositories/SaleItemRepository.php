<?php

namespace App\Repositories;

use App\Models\SaleItem;
use App\Interfaces\SaleItemRepositoryInterface;

class SaleItemRepository implements SaleItemRepositoryInterface
{
    public function create(array $data): SaleItem
    {
        return SaleItem::create($data);
    }

    public function deleteBySale(int $saleId): void
    {
        SaleItem::where('sale_id', $saleId)->delete();
    }
}
