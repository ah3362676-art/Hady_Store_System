<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Services\BrandService;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;

class BrandController extends Controller
{
    public function __construct(
        protected BrandService $brandService
    ) {}

    public function index()
    {
        $brands = $this->brandService->paginate();

        return view('brands.index', compact('brands'));
    }

    public function create()
    {
        return view('brands.create');
    }

    public function store(StoreBrandRequest $request)
    {
        $this->brandService->create($request->validated());

        return redirect()
            ->route('brands.index')
            ->with('success', __('messages.brand_created_successfully'));
    }

    public function edit(Brand $brand)
    {
        return view('brands.edit', compact('brand'));
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $this->brandService->update($brand, $request->validated());

        return redirect()
            ->route('brands.index')
            ->with('success', __('messages.brand_updated_successfully'));
    }

    public function destroy(Brand $brand)
    {
        $this->brandService->delete($brand);

        return redirect()
            ->route('brands.index')
            ->with('success', __('messages.brand_deleted_successfully'));
    }
}
