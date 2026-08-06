<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Interfaces\StatementRepositoryInterface;

class StatementRepository implements StatementRepositoryInterface
{
    public function customerStatement(Customer $customer, array $filters = []): array
    {
        $rows = [];

        $sales = $customer->sales();

        if (!empty($filters['from_date'])) {
            $sales->whereDate('sale_date', '>=', $filters['from_date']);
        }

        if (!empty($filters['to_date'])) {
            $sales->whereDate('sale_date', '<=', $filters['to_date']);
        }

        foreach ($sales->get() as $sale) {

            $rows[] = [
                'date'    => $sale->sale_date,
                'type'    => 'Sale',
                'number'  => $sale->invoice_number,
                'debit'   => $sale->total,
                'credit'  => 0,
            ];
        }

        $payments = $customer->payments();

        if (!empty($filters['from_date'])) {
            $payments->whereDate('payment_date', '>=', $filters['from_date']);
        }

        if (!empty($filters['to_date'])) {
            $payments->whereDate('payment_date', '<=', $filters['to_date']);
        }

        foreach ($payments->get() as $payment) {

            $rows[] = [
                'date'    => $payment->payment_date,
                'type'    => 'Payment',
                'number'  => $payment->receipt_number,
                'debit'   => 0,
                'credit'  => $payment->amount,
            ];
        }

        usort($rows, function ($a, $b) {

            return strtotime($a['date']) <=> strtotime($b['date']);

        });

        $balance = 0;

        foreach ($rows as &$row) {

            $balance += $row['debit'];
            $balance -= $row['credit'];

            $row['balance'] = $balance;
        }

        return $rows;
    }
}
