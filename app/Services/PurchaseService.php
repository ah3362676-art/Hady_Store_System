<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use App\Interfaces\PurchaseRepositoryInterface;
use App\Interfaces\PurchaseItemRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Traits\GeneratesNumbers;

class PurchaseService
{
    use GeneratesNumbers;

    public function __construct(
        protected PurchaseRepositoryInterface $purchaseRepository,
        protected PurchaseItemRepositoryInterface $purchaseItemRepository
    ) {
    }

    public function paginate(): LengthAwarePaginator
    {
        return $this->purchaseRepository->paginate();
    }

    public function create(array $data): Purchase
    {
        return DB::transaction(function () use ($data) {

            $data['invoice_number'] = $this->generateNumber(
                'PUR',
                Purchase::class,
                'invoice_number'
            );

            $subtotal = 0;

            foreach ($data['items'] as $item) {

                $subtotal += $item['purchase_price'] * $item['quantity'];

            }

            $discount = $data['discount'] ?? 0;

            $total = $subtotal - $discount;

            $paid = $data['paid'];

            $due = $total - $paid;

            $purchase = $this->purchaseRepository->create([

                'supplier_id'    => $data['supplier_id'],
                'invoice_number' => $data['invoice_number'],
                'purchase_date'  => $data['purchase_date'],
                'subtotal'       => $subtotal,
                'discount'       => $discount,
                'total'          => $total,
                'paid'           => $paid,
                'due'            => $due,
                'payment_method' => $data['payment_method'],
                'notes'          => $data['notes'] ?? null,

            ]);

            foreach ($data['items'] as $item) {

                $this->purchaseItemRepository->create([

                    'purchase_id'    => $purchase->id,
                    'product_id'     => $item['product_id'],
                    'purchase_price' => $item['purchase_price'],
                    'quantity'       => $item['quantity'],
                    'expiry_date'    => $item['expiry_date'] ?? null,
                    'total'          => $item['purchase_price'] * $item['quantity'],

                ]);

                $product = Product::findOrFail($item['product_id']);

                $product->increment('quantity', $item['quantity']);

                $product->update([
                    'purchase_price' => $item['purchase_price'],
                ]);
            }

            Supplier::findOrFail($data['supplier_id'])
                ->increment('balance', $due);

            return $purchase;

        });
    }
    public function update(Purchase $purchase, array $data): Purchase
{
    return DB::transaction(function () use ($purchase, $data) {

        $purchase->load('items');

        $subtotal = 0;

        foreach ($data['items'] as $item) {

            $subtotal += $item['purchase_price'] * $item['quantity'];

        }

        $discount = $data['discount'] ?? 0;

        $total = $subtotal - $discount;

        $paid = $data['paid'];

        $due = $total - $paid;

        /*
        |---------------------------------------------------------
        | رجع الكميات القديمة للمخزون
        |---------------------------------------------------------
        */

        foreach ($purchase->items as $oldItem) {

            $product = Product::findOrFail($oldItem->product_id);

            $product->decrement('quantity', $oldItem->quantity);

        }

        /*
        |---------------------------------------------------------
        | رجع رصيد المورد القديم
        |---------------------------------------------------------
        */

        Supplier::findOrFail($purchase->supplier_id)
            ->decrement('balance', $purchase->due);

        /*
        |---------------------------------------------------------
        | احذف الـ Items القديمة
        |---------------------------------------------------------
        */

        $this->purchaseItemRepository
            ->deleteByPurchase($purchase->id);

        /*
        |---------------------------------------------------------
        | حدث بيانات الفاتورة
        |---------------------------------------------------------
        */

        $this->purchaseRepository->update($purchase, [

            'supplier_id'    => $data['supplier_id'],
            'invoice_number' => $purchase->invoice_number,
            'purchase_date'  => $data['purchase_date'],
            'subtotal'       => $subtotal,
            'discount'       => $discount,
            'total'          => $total,
            'paid'           => $paid,
            'due'            => $due,
            'payment_method' => $data['payment_method'],
            'notes'          => $data['notes'] ?? null,

        ]);

        /*
        |---------------------------------------------------------
        | إنشاء الـ Purchase Items الجديدة
        |---------------------------------------------------------
        */

        foreach ($data['items'] as $item) {

            $this->purchaseItemRepository->create([

                'purchase_id'    => $purchase->id,
                'product_id'     => $item['product_id'],
                'purchase_price' => $item['purchase_price'],
                'quantity'       => $item['quantity'],
                'expiry_date'    => $item['expiry_date'] ?? null,
                'total'          => $item['purchase_price'] * $item['quantity'],

            ]);

            $product = Product::findOrFail($item['product_id']);

            $product->increment('quantity', $item['quantity']);

            $product->update([
                'purchase_price' => $item['purchase_price'],
            ]);

        }

        /*
        |---------------------------------------------------------
        | تحديث رصيد المورد
        |---------------------------------------------------------
        */

        Supplier::findOrFail($data['supplier_id'])
            ->increment('balance', $due);

        return $purchase;

    });
}

public function delete(Purchase $purchase): bool
{
    return DB::transaction(function () use ($purchase) {

        $purchase->load('items');

        // رجوع الكميات للمخزون
        foreach ($purchase->items as $item) {

            $product = Product::findOrFail($item->product_id);

            $product->decrement('quantity', $item->quantity);

        }

        // خصم المديونية من المورد
        Supplier::findOrFail($purchase->supplier_id)
            ->decrement('balance', $purchase->due);

        // حذف العناصر
        $this->purchaseItemRepository
            ->deleteByPurchase($purchase->id);

        // حذف الفاتورة
        return $this->purchaseRepository
            ->delete($purchase);

    });
}
}
