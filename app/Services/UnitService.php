<?php

namespace App\Services;

use App\Models\Unit;
use App\Interfaces\UnitRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UnitService
{
    public function __construct(
        protected UnitRepositoryInterface $unitRepository
    ) {}

    public function paginate(): LengthAwarePaginator
    {
        return $this->unitRepository->paginate();
    }

    public function create(array $data): Unit
    {
        return $this->unitRepository->create($data);
    }

    public function update(Unit $unit, array $data): bool
    {
        return $this->unitRepository->update($unit, $data);
    }

    public function delete(Unit $unit): bool
    {
        return $this->unitRepository->delete($unit);
    }
}
