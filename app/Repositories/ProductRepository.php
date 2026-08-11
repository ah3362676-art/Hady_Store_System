<?php

namespace App\Repositories;

use App\Models\Product;
use Carbon\Carbon;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class ProductRepository implements ProductRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Product::with([
            'category',
            'brand',
            'unit',
        ])
        ->withMin([
            'purchaseItems as nearest_expire_date' => function ($query) {
                $query->whereNotNull('expiry_date')
                      ->whereDate('expiry_date', '>=', Carbon::today());
            }
        ], 'expiry_date')
        ->latest()
        ->paginate($perPage);
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(Product $product, array $data): bool
    {
        return $product->update($data);
    }


public function expiringSoon(int $days = 30)
{
    return Product::withMin([
        'purchaseItems as nearest_expire_date' => function ($query) use ($days) {

            $query->whereNotNull('expiry_date')
                ->whereBetween('expiry_date', [
                    Carbon::today(),
                    Carbon::today()->addDays($days),
                ]);

        }
    ], 'expiry_date')
    ->having('nearest_expire_date', '!=', null)
    ->orderBy('nearest_expire_date')
    ->get();
}

    public function delete(Product $product): bool
    {
        return $product->delete();
    }
}
