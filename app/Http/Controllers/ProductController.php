<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use App\Services\ProductService;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {
    }

    public function index()
    {
        $products = $this->productService->paginate();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create', [
            'categories' => Category::all(),
            'brands' => Brand::all(),
            'units' => Unit::all(),
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $this->productService->create($request->validated());

        return redirect()
            ->route('products.index')
            ->with('success', __('messages.product_created_successfully'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product,
            'categories' => Category::all(),
            'brands' => Brand::all(),
            'units' => Unit::all(),
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->productService->update($product, $request->validated());

        return redirect()
            ->route('products.index')
            ->with('success', __('messages.product_updated_successfully'));
    }

    public function destroy(Product $product)
    {
        $this->productService->delete($product);

        return redirect()
            ->route('products.index')
            ->with('success', __('messages.product_deleted_successfully'));
    }
}
