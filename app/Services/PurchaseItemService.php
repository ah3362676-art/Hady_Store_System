<?php

namespace App\Services;

use App\Interfaces\PurchaseItemRepositoryInterface;

class PurchaseItemService
{
    public function __construct(
        protected PurchaseItemRepositoryInterface $purchaseItemRepository
    ) {
    }

    public function create(array $data)
    {
        return $this->purchaseItemRepository->create($data);
    }



    public function deleteByPurchase(int $purchaseId): void
    {
        $this->purchaseItemRepository->deleteByPurchase($purchaseId);
    }
}
