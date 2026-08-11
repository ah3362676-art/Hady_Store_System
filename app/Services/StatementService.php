<?php

namespace App\Services;

use App\Models\Customer;
use App\Interfaces\StatementRepositoryInterface;

class StatementService
{
    public function __construct(
        protected StatementRepositoryInterface $statementRepository
    ) {
    }

public function customerStatement(Customer $customer, array $filters = []): array
{
    return $this->statementRepository
        ->customerStatement($customer, $filters);
}
}
