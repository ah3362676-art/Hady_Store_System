<?php

namespace App\Interfaces;

use App\Models\PurchaseItem;

interface PurchaseItemRepositoryInterface
{
    // إنشاء سجل منتج واحد داخل فاتورة الشراء
    public function create(array $data): PurchaseItem;



    // حذف جميع منتجات فاتورة شراء معينة باستخدام رقم الفاتورة
    public function deleteByPurchase(int $purchaseId): void;
}
