<?php

namespace App\Services;

use App\Models\Brand;
use App\Interfaces\BrandRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BrandService
{
    public function __construct(
        protected BrandRepositoryInterface $brandRepository
    ) {}

    public function paginate(): LengthAwarePaginator
    {
        return $this->brandRepository->paginate();
    }

    public function create(array $data): Brand
    {
        return $this->brandRepository->create($data);
    }

    public function update(Brand $brand, array $data): bool
    {
        return $this->brandRepository->update($brand, $data);
    }

    public function delete(Brand $brand): bool
    {
        return $this->brandRepository->delete($brand);
    }
}
