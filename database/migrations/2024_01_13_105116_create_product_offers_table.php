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
        Schema::create('product_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->unsignedBigInteger('offer_id');
            $table->string('name');
            $table->string('category');
            $table->string('product_size');
            $table->text('type');
            $table->string('material');
            $table->string('color');
            $table->string('detail');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->string('currency');
            $table->softDeletes();
            $table->timestamps();
//
            $table->foreign('offer_id')->references('id')->on('offers');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_offers');
    }
};
