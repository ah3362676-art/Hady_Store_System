<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'name',  // اسم البرودكت
        'barcode',  // الباركود
        'purchase_price', // سعر الشراء
        'sale_price', // سعر البيع
        'minimum_sale_price', // الحد الأدنى لسعر البيع
        'quantity', // الكمية
        'reorder_level', // مستوى إعادة الطلب
        'description', // الوصف
        'is_active',
        'image',
        'category_id',
        'brand_id',
        'unit_id',
    ];

    protected $casts = [
        'purchase_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'minimum_sale_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

//Accessor => الكلمة نفسها معناها "طريقة للحصول على قيمة".

// هو دالة بتخليك تضيف خاصية وهمية للموديل，
// الخاصية دي مش موجودة في قاعدة البيانات، لكن تقدر تستخدمها كأنها موجود
//لكن أنت عايز  تكتب : profit_percentage مفيش عمود اسمه
// $product->profit_percentage => عشن تجيب نسبة الربح
//   لو لاقها يجبها ويرجع النتيجة  getProfitPercentageAttribute() بيدور جوه الموديل. هل فيه دالة اسمها Laravel
// طب نا بستخدم الاختصار دة لي اسم الدالة طويل كدا عشن لازم يبقي فيها
// get =>get
// اسم الخاصية=> ProfitPercentage
// Attribute =>Attribute

    public function getProfitPercentageAttribute(): float
    {
        if ($this->purchase_price <= 0) {   //  سعر الشراء
            return 0;
        }

        return round(
            (($this->sale_price - $this->purchase_price) / $this->purchase_price) * 100,
            2
        );
    }

    public function saleItems()
{
    return $this->hasMany(SaleItem::class);
}
public function purchaseItems()
{
    return $this->hasMany(PurchaseItem::class);
}
}
