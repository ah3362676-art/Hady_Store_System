<?php

namespace App\Repositories;

use App\Models\PurchaseItem;
use App\Interfaces\PurchaseItemRepositoryInterface;

class PurchaseItemRepository implements PurchaseItemRepositoryInterface
{
    public function create(array $data): PurchaseItem
    {
        return PurchaseItem::create($data);
    }



    public function deleteByPurchase(int $purchaseId): void
    {
        PurchaseItem::where('purchase_id', $purchaseId)->delete();
    }
}
