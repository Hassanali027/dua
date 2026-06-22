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
            $table->boolean('is_most_in_demand')->default(false)->after('status');
            $table->boolean('is_new_arrival')->default(false)->after('is_most_in_demand');
            $table->boolean('is_bridal_party_wear')->default(false)->after('is_new_arrival');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['is_most_in_demand', 'is_new_arrival', 'is_bridal_party_wear']);
        });
    }
};
