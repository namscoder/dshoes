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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('total_money');
            $table->integer('transport_fee');
            $table->string('discount_code')->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('delivery');
            $table->string('recipient_name')->nullable();
            $table->string('recipient_phone_number')->nullable();
            $table->text('delivery_address')->nullable();
            $table->tinyInteger('payment_method')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
