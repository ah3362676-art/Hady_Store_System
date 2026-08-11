<?php

namespace App\Interfaces;

use App\Models\SaleItem;

interface SaleItemRepositoryInterface
{
    public function create(array $data): SaleItem;

    public function deleteBySale(int $saleId): void;
}
