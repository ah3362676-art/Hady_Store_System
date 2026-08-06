<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    /** @use HasFactory<\Database\Factories\PurchaseFactory> */
use HasFactory, SoftDeletes;

//Purchase =>  يمثل فاتورة الشراء نفسها من المورد او الشركة مش فاتورة الزبون (رأس الفاتورة).
protected $fillable = [

    'supplier_id',     // المورد الذي تم الشراء منه.
    'invoice_number',  //رقم فاتورة الشراء
    'purchase_date',  // تاريخ الشراء.
    'subtotal',       // إجمالي المنتجات قبل الخصم.
    'discount',       // قيمة الخصم على الفاتورة.
    'total',         // الإجمالي النهائي بعد الخصم.
    'paid',          // المبلغ الذي تم دفعه للمورد.
    'due',           // المبلغ المتبقي للمورد.
    'payment_method',   // طريقة الدفع (Cash، Visa، ...).
    'notes',            //أي ملاحظات على الفاتورة.
];
protected $casts = [
    'purchase_date' => 'datetime:Y-m-d',
];

public function supplier()
{
    return $this->belongsTo(Supplier::class);
}

public function items()
{
    return $this->hasMany(PurchaseItem::class);
}

}
