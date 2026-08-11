<?php

namespace App\Services;

use App\Models\Product;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    ) {}

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->productRepository->paginate($perPage);
    }

    public function create(array $data): Product
    {
        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('products', 'public');
        }

        return $this->productRepository->create($data);
    }

    public function update(Product $product, array $data): bool
    {
        if (isset($data['image'])) {

            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $data['image']->store('products', 'public');
        }

        return $this->productRepository->update($product, $data);
    }

    public function expiringSoon(int $days = 30)
{
    return $this->productRepository->expiringSoon($days);
}

    public function delete(Product $product): bool
    {
        return $this->productRepository->delete($product);
    }
}
