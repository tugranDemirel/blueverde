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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('delivery_id')->constrained('system_delivery_methods');
            $table->foreignId('product_tag_id')->constrained('product_tags');
            $table->json('term_of_offer');
            $table->json('products');
            $table->string('tax');
            $table->string('discount');
            $table->string('total');
            $table->boolean('status')->default(false);
            $table->tinyInteger('offer_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
