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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('current_type')->comment('0: current, 1: Not Current');
            $table->tinyInteger('individual')->comment('0: Bireysel, 1: Kurumsal');
            $table->boolean('personal_type')->comment('0: Yurtiçi Müşteri, 1: YurtDIşı Müşteri');
            $table->json('address')->nullable();
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->string('post_code')->nullable();
            $table->string('phone')->nullable();
            $table->string('mail')->nullable();
            $table->json('authorized_person')->nullable();
            $table->string('tax_authority')->nullable()->comment('vergi dairesi');
            $table->string('identity_number')->nullable()->comment('vergi ya da tc no');
            $table->string('eori_number')->nullable()->comment('Eori number Yurtdışı Müşteri');
            $table->string('bank_info')->nullable()->comment('banka bilgileri');
            $table->string('description')->nullable()->comment('açıklama');
            $table->string('file')->nullable()->comment('açıklama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
