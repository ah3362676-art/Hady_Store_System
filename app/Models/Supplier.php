<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;
    // Supplier معناها المورد.
    // وهو الشخص أو الشركة اللي بتشتري منها البضاعة علشان تبيعها في محلك.

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'balance',
        'notes',
        'is_active',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function payments()
{
    return $this->hasMany(SupplierPayment::class);
}
}
