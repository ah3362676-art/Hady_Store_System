<?php

namespace App\Interfaces;

interface ReportRepositoryInterface
{
    public function summary(array $filters = []): array;
}
