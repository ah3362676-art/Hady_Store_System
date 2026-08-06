<?php

namespace App\Interfaces;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    public function create(array $data): Product;

    public function update(Product $product, array $data): bool;

    public function expiringSoon(int $days = 30);


    public function delete(Product $product): bool;

}
