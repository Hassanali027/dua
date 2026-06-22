<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_on_sale')->default(false)->after('price');
            $table->decimal('sale_price', 10, 2)->nullable()->after('is_on_sale');
            $table->string('color')->nullable()->after('sale_price');
            $table->string('size')->nullable()->after('color');
            $table->integer('quantity')->default(0)->after('size');
            $table->text('product_detail')->nullable()->after('quantity');
            $table->string('season')->nullable()->after('product_detail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'is_on_sale',
                'sale_price',
                'color',
                'size',
                'quantity',
                'product_detail',
                'season'
            ]);
        });
    }
};
