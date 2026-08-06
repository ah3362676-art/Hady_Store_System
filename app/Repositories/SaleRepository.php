<?php

namespace App\Repositories;

use App\Models\Sale;
use App\Interfaces\SaleRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SaleRepository implements SaleRepositoryInterface
{
public function paginate(array $filters = [], int $perPage = 10): LengthAwarePaginator
{
    $query = Sale::with('customer');

    if (!empty($filters['from_date'])) {
        $query->whereDate('sale_date', '>=', $filters['from_date']);
    }

    if (!empty($filters['to_date'])) {
        $query->whereDate('sale_date', '<=', $filters['to_date']);
    }

    if (!empty($filters['invoice_number'])) {
        $query->where(
            'invoice_number',
            'like',
            '%' . $filters['invoice_number'] . '%'
        );
    }

    if (!empty($filters['customer'])) {
        $query->whereHas('customer', function ($q) use ($filters) {
            $q->where(
                'name',
                'like',
                '%' . $filters['customer'] . '%'
            );
        });
    }

    if (!empty($filters['payment_method'])) {
        $query->where(
            'payment_method',
            $filters['payment_method']
        );
    }

    return $query
        ->latest()
        ->paginate($perPage)
        ->withQueryString();
}

    public function create(array $data): Sale
    {
        return Sale::create($data);
    }

    public function update(Sale $sale, array $data): bool
    {
        return $sale->update($data);
    }

    public function delete(Sale $sale): bool
    {
        return $sale->delete();
    }
}
