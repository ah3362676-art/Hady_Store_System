<?php

namespace App\Repositories;

use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Customer;
use App\Models\Supplier;
use App\Interfaces\ReportRepositoryInterface;

class ReportRepository implements ReportRepositoryInterface
{
    public function summary(array $filters = []): array
    {
        $sales = Sale::query();
        $purchases = Purchase::query();

        if (!empty($filters['from_date'])) {
            $sales->whereDate('sale_date', '>=', $filters['from_date']);
            $purchases->whereDate('purchase_date', '>=', $filters['from_date']);
        }

        if (!empty($filters['to_date'])) {
            $sales->whereDate('sale_date', '<=', $filters['to_date']);
            $purchases->whereDate('purchase_date', '<=', $filters['to_date']);
        }

        $salesTotal = $sales->sum('total');
        $purchasesTotal = $purchases->sum('total');

        return [
            'salesTotal'      => $salesTotal,
            'purchasesTotal'  => $purchasesTotal,
            'profit'          => $salesTotal - $purchasesTotal,
            'customerDue'     => Customer::sum('balance'),
            'supplierDue'     => Supplier::sum('balance'),
        ];
    }
}
