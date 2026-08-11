<?php

namespace App\Interfaces;

use App\Models\Unit;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UnitRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    public function create(array $data): Unit;

    public function update(Unit $unit, array $data): bool;

    public function delete(Unit $unit): bool;
}
