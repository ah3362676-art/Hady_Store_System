<?php

namespace App\Interfaces;

use App\Models\Brand;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BrandRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    public function create(array $data): Brand;

    public function update(Brand $brand, array $data): bool;

    public function delete(Brand $brand): bool;
}
