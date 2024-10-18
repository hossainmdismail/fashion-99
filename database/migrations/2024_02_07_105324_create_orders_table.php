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
            $table->bigInteger('user_id')->nullable();
            $table->string('order_id')->unique();
            // $table->string('name');
            // $table->string('number');
            // $table->string('email')->nullable();
            // $table->string('address');
            $table->decimal('shipping_charge', 10, 2)->nullable();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->decimal('offer_price', 10, 2)->default(0.00);
            $table->bigInteger('coupon_id')->nullable();
            $table->bigInteger('coupon_amount')->nullable();
            $table->enum('order_status', ['pending', 'processing', 'shipping', 'return', 'cancel', 'damage', 'delieverd']);
            $table->longText('client_message')->nullable();
            $table->longText('admin_message')->nullable();
            $table->bigInteger('payment_method')->nullable(); //future payment
            $table->enum('payment_status', ['processing', 'paid', 'due', 'cancel'])->default('processing');
            $table->integer('notification')->default(1);
            $table->timestamps();
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
