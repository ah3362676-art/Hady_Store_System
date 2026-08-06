<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Services\UnitService;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;

class UnitController extends Controller
{
    public function __construct(
        protected UnitService $unitService
    ) {
    }

    public function index()
    {
        $units = $this->unitService->paginate();

        return view('units.index', compact('units'));
    }

    public function create()
    {
        return view('units.create');
    }

    public function store(StoreUnitRequest $request)
    {
        $this->unitService->create($request->validated());

        return redirect()
            ->route('units.index')
            ->with('success', __('messages.unit_created_successfully'));
    }

    public function edit(Unit $unit)
    {
        return view('units.edit', compact('unit'));
    }

    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $this->unitService->update($unit, $request->validated());

        return redirect()
            ->route('units.index')
            ->with('success', __('messages.unit_updated_successfully'));
    }

    public function destroy(Unit $unit)
    {
        $this->unitService->delete($unit);

        return redirect()
            ->route('units.index')
            ->with('success', __('messages.unit_deleted_successfully'));
    }
}
