<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerPayment extends Model
{
    // الحقول المسموح بعمل Mass Assignment عليها
    protected $fillable = [

        // العميل الذي قام بالدفع
        'customer_id',

        // رقم الفاتورة بتاع الفلوس الي دفعها
        'receipt_number',

        // تاريخ استلام الدفعة
        'payment_date',

        // قيمة المبلغ المستلم
        'amount',

        // طريقة الدفع (كاش - فودافون كاش ...)
        'payment_method',

        // أي ملاحظات إضافية
        'notes',
    ];

    // العلاقة: كل عملية تحصيل تخص عميل واحد
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
