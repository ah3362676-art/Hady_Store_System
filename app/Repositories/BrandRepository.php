<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Interfaces\BrandRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BrandRepository implements BrandRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Brand::latest()->paginate($perPage);
    }

    public function create(array $data): Brand
    {
        return Brand::create($data);
    }

    public function update(Brand $brand, array $data): bool
    {
        return $brand->update($data);
    }

    public function delete(Brand $brand): bool
    {
        return $brand->delete();
    }
}
