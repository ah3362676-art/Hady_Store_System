<?php

namespace App\Traits;

trait GeneratesNumbers
{
    protected function generateNumber(string $prefix, string $model, string $column): string
    {
        $last = $model::latest('id')->value($column);

        if (!$last) {
            return $prefix . '000001';
        }

        $number = (int) substr($last, strlen($prefix));

        return $prefix . str_pad($number + 1, 6, '0', STR_PAD_LEFT);
    }
}
