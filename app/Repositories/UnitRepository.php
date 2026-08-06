<?php

namespace App\Repositories;

use App\Models\Unit;
use App\Interfaces\UnitRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UnitRepository implements UnitRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Unit::latest()->paginate($perPage);
    }

    public function create(array $data): Unit
    {
        return Unit::create($data);
    }

    public function update(Unit $unit, array $data): bool
    {
        return $unit->update($data);
    }

    public function delete(Unit $unit): bool
    {
        return $unit->delete();
    }
}
