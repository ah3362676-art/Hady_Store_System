<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition(): array
    {
        return [

            'name' => fake()->company(),

            'phone' => fake()->unique()->phoneNumber(),

            'email' => fake()->safeEmail(),

            'address' => fake()->address(),

            'balance' => 0,

            'notes' => fake()->sentence(),

            'is_active' => true,

        ];
    }
}
