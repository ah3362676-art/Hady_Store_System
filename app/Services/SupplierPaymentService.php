<?php

namespace App\Services;

use App\Models\Supplier;
use App\Models\SupplierPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Interfaces\SupplierPaymentRepositoryInterface;
use App\Traits\GeneratesNumbers;


class SupplierPaymentService
{
        use GeneratesNumbers;

    public function __construct(
        protected SupplierPaymentRepositoryInterface $supplierPaymentRepository
    ) {
    }

    public function paginate(): LengthAwarePaginator
    {
        return $this->supplierPaymentRepository->paginate();
    }

    public function create(array $data): SupplierPayment
    {
        return DB::transaction(function () use ($data) {
             $data['receipt_number'] = $this->generateNumber(
            'CPY',
            supplierPayment::class,
            'receipt_number'
        );

            $payment = $this->supplierPaymentRepository->create([

                'supplier_id'    => $data['supplier_id'],
                'receipt_number' => $data['receipt_number'],
                'payment_date'   => $data['payment_date'],
                'amount'         => $data['amount'],
                'payment_method' => $data['payment_method'],
                'notes'          => $data['notes'] ?? null,

            ]);

            Supplier::findOrFail($data['supplier_id'])
                ->decrement('balance', $data['amount']);

            return $payment;
        });
    }

    public function update(SupplierPayment $supplierPayment, array $data): bool
    {
        return DB::transaction(function () use ($supplierPayment, $data) {

            Supplier::findOrFail($supplierPayment->supplier_id)
                ->increment('balance', $supplierPayment->amount);

            $this->supplierPaymentRepository->update($supplierPayment, [

                'supplier_id'    => $data['supplier_id'],
                'receipt_number' => $supplierPayment->receipt_number,
                'payment_date'   => $data['payment_date'],
                'amount'         => $data['amount'],
                'payment_method' => $data['payment_method'],
                'notes'          => $data['notes'] ?? null,

            ]);

            Supplier::findOrFail($data['supplier_id'])
                ->decrement('balance', $data['amount']);

            return true;
        });
    }

    public function delete(SupplierPayment $supplierPayment): bool
    {
        return DB::transaction(function () use ($supplierPayment) {

            Supplier::findOrFail($supplierPayment->supplier_id)
                ->increment('balance', $supplierPayment->amount);

            return $this->supplierPaymentRepository
                ->delete($supplierPayment);

        });
    }
}
