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
           /* $table->index('system_currency_id')->after('product_tag_id');
            $table->foreign('system_currency_id')->references('id')->on('system_currencies')*/
            $table->foreignId('system_currency_id')
                ->nullable()
                ->after('product_tag_id')
                ->constrained('system_currencies')
                ->nullOnDelete();
            $table->string('image')->after('description');
            $table->string('meta_keywords')->after('image');
            $table->string('meta_description')->after('meta_keywords');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('meta_keywords');
            $table->dropColumn('meta_description');
            $table->dropColumn('system_currency_id');

        });
    }
};
