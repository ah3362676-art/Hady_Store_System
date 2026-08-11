<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();

            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnUpdate() // لو قيمة المفتاح الأساسي  اتغيرت، حدّثها تلقائيًا في الجدول ده.
                ->restrictOnDelete();  // امنع حذف السجل لو في بيانات مرتبطة بيه.

            $table->foreignId('brand_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('unit_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('name')->unique();

            $table->decimal('purchase_price', 10, 2); //سعر الشراء

            $table->decimal('sale_price', 10, 2);    // سعر البيع

            $table->decimal('minimum_sale_price', 10, 2);  // اقل سعر للبيع

            $table->integer('quantity')->default(0);  // الكمية

            $table->integer('reorder_level')->default(0);  // مستوى إعادة الطلب

            $table->text('description')->nullable();

            $table->boolean('is_active')->default(true);

            $table->string('image')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
