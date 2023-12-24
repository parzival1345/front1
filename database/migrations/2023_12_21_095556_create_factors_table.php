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
        Schema::create('factors', function (Blueprint $table) {
            $table->id();
            $table->integer('factor_id');
            $table->bigInteger('finally_price');
//            $table->string('notes');
//            $table->enum('payment_method',['پرداخت درب منزل','پرداخت انلاین']);
            $table->enum('status',['پرداخت شده','در حال پرداخت'])->default('در حال پرداخت');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factors');
    }
};
