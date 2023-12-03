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
            $table->json('type')->nullable()->after('code');
            $table->string('product_size')->nullable()->after('type');
            $table->string('material')->nullable()->after('product_size');
            $table->string('color')->nullable()->after('material');
            $table->text('detail')->nullable()->after('color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['type', 'product_size', 'material', 'color', 'detail']);
        });
    }
};
