<?php

namespace App\Services;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use App\Interfaces\SaleRepositoryInterface;
use App\Interfaces\SaleItemRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Traits\GeneratesNumbers;

class SaleService
{
        use GeneratesNumbers;
    public function __construct(
        protected SaleRepositoryInterface $saleRepository,
        protected SaleItemRepositoryInterface $saleItemRepository
    ) {
    }

public function paginate(array $filters = [])
{
    return $this->saleRepository->paginate($filters);
}

    public function create(array $data): Sale
    {
        return DB::transaction(function () use ($data) {
            // انشاء فاتورة
   $data['invoice_number'] = $this->generateNumber(
    'SAL',
    Sale::class,
    'invoice_number'
);

            $subtotal = 0;

            foreach ($data['items'] as $item) {

                $product = Product::findOrFail($item['product_id']);

                if ($item['quantity'] > $product->quantity) {
                    throw new \Exception(
                        "Insufficient stock for {$product->name}."
                    );
                }

                if ($item['sale_price'] < $product->minimum_sale_price) {
                    throw new \Exception(
                        "{$product->name} cannot be sold below the minimum sale price."
                    );
                }

                $subtotal += $item['sale_price'] * $item['quantity'];
            }

            $discount = $data['discount'] ?? 0;

            $total = $subtotal - $discount;

            $paid = $data['paid'];

            $due = $total - $paid;

            $sale = $this->saleRepository->create([
                'customer_id'    => $data['customer_id']??null,
                'invoice_number' => $data['invoice_number'],
                'sale_date'      => $data['sale_date'],
                'subtotal'       => $subtotal,
                'discount'       => $discount,
                'total'          => $total,
                'paid'           => $paid,
                'due'            => $due,
                'payment_method' => $data['payment_method'],
                'notes'          => $data['notes'] ?? null,
            ]);

            foreach ($data['items'] as $item) {

                $this->saleItemRepository->create([
                    'sale_id'    => $sale->id,
                    'product_id' => $item['product_id'],
                    'sale_price' => $item['sale_price'],
                    'quantity'   => $item['quantity'],
                    'total'      => $item['sale_price'] * $item['quantity'],
                ]);

                Product::findOrFail($item['product_id'])
                    ->decrement('quantity', $item['quantity']);
            }

if (!empty($data['customer_id'])) {
    Customer::findOrFail($data['customer_id'])
        ->increment('balance', $due);
}

            return $sale;
        });
    }
public function update(Sale $sale, array $data): bool
{
    return DB::transaction(function () use ($sale, $data) {

        $sale->load('items');

        // رجوع الكميات القديمة للمخزون
        foreach ($sale->items as $item) {

            $product = Product::findOrFail($item->product_id);

            $product->increment('quantity', $item->quantity);
        }

        // إلغاء المديونية القديمة للعميل
        Customer::findOrFail($sale->customer_id)
            ->decrement('balance', $sale->due);

        // حذف الأصناف القديمة
        $this->saleItemRepository->deleteBySale($sale->id);

        $subtotal = 0;

        foreach ($data['items'] as $item) {

            $subtotal +=$item['sale_price'] * $item['quantity'];
        }

        $discount = $data['discount'] ?? 0;

        $total = $subtotal - $discount;

        $paid = $data['paid'];

        $due = $total - $paid;

        $this->saleRepository->update($sale, [

            'customer_id'    => $data['customer_id']??null,
            'invoice_number' =>  $sale->invoice_number,
            'sale_date'      => $data['sale_date'],
            'subtotal'       => $subtotal,
            'discount'       => $discount,
            'total'          => $total,
            'paid'           => $paid,
            'due'            => $due,
            'payment_method' => $data['payment_method'],
            'notes'          => $data['notes'] ?? null,

        ]);

        foreach ($data['items'] as $item) {

            $this->saleItemRepository->create([

                'sale_id'    => $sale->id,
                'product_id' => $item['product_id'],
                'sale_price' => $item['sale_price'],
                'quantity'   => $item['quantity'],
                'total'      => $item['sale_price'] * $item['quantity'],

            ]);

            $product = Product::findOrFail($item['product_id']);

            $product->decrement('quantity', $item['quantity']);
        }

        if (!empty($data['customer_id'])) {
            Customer::findOrFail($data['customer_id'])
                ->increment('balance', $due);
        }

        return true;
    });
}

public function delete(Sale $sale): bool
{
    return DB::transaction(function () use ($sale) {

        $sale->load('items');

        // رجوع الكميات للمخزون
        foreach ($sale->items as $item) {

            $product = Product::findOrFail($item->product_id);

            $product->increment('quantity', $item->quantity);
        }

        // خصم المديونية من العميل
        if (!empty($sale->customer_id)) {
            Customer::findOrFail($sale->customer_id)
                ->decrement('balance', $sale->due);
        }

        // حذف الأصناف
        $this->saleItemRepository->deleteBySale($sale->id);

        // حذف الفاتورة
        return $this->saleRepository->delete($sale);

    });
}
}
