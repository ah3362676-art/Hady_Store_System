<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct(
        protected ReportService $reportService
    ) {
    }

    public function index(Request $request)
    {
        $summary = $this->reportService->summary($request->all());

        return view('reports.index', compact('summary'));
    }
}
