<?php

namespace App\Interfaces;

use App\Models\Customer;

interface StatementRepositoryInterface
{
public function customerStatement(Customer $customer, array $filters = []): array;
}
