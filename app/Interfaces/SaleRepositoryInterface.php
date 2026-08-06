<?php

namespace App\Interfaces;

use App\Models\Sale;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface SaleRepositoryInterface
{
public function paginate(array $filters = [], int $perPage = 10): LengthAwarePaginator;
    public function create(array $data): Sale;

    public function update(Sale $sale, array $data): bool;

    public function delete(Sale $sale): bool;
}
