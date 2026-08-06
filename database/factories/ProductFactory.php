<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $purchase = fake()->randomFloat(2, 10, 500);

        $sale = $purchase + fake()->randomFloat(2, 5, 150);

        return [
            'category_id' => Category::inRandomOrder()->value('id'),

            'brand_id' => Brand::inRandomOrder()->value('id'),

            'unit_id' => Unit::inRandomOrder()->value('id'),

            'name' => fake()->unique()->words(2, true),

            'purchase_price' => $purchase,

            'sale_price' => $sale,

            'minimum_sale_price' => $purchase,

            'quantity' => fake()->numberBetween(0, 100),

            'reorder_level' => fake()->numberBetween(5, 20),

            'description' => fake()->sentence(),

            'is_active' => true,

            'image' => null,
        ];
    }
}
