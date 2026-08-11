<?php

namespace Database\Factories;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnitFactory extends Factory
{
    protected $model = Unit::class;

    public function definition(): array
    {
        $units = [
            ['name' => 'Piece', 'symbol' => 'Pc'],
            ['name' => 'Bottle', 'symbol' => 'Btl'],
            ['name' => 'Liter', 'symbol' => 'L'],
            ['name' => 'Kilogram', 'symbol' => 'Kg'],
            ['name' => 'Carton', 'symbol' => 'Ctn'],
            ['name' => 'Pack', 'symbol' => 'Pk'],
            ['name' => 'Box', 'symbol' => 'Box'],
            ['name' => 'Gallon', 'symbol' => 'Gal'],
        ];

        $unit = fake()->unique()->randomElement($units);

        return [
            'name' => $unit['name'],
            'symbol' => $unit['symbol'],
            'is_active' => true,
        ];
    }
}
