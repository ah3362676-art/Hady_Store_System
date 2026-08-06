<?php

namespace App\Services;

use App\Interfaces\ReportRepositoryInterface;

class ReportService
{
    public function __construct(
        protected ReportRepositoryInterface $reportRepository
    ) {
    }

    public function summary(array $filters = []): array
    {
        return $this->reportRepository->summary($filters);
    }
}
