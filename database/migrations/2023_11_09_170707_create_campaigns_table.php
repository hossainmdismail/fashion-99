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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_for');
            $table->string('campaign_name');
            $table->string('campaign_image');
            $table->bigInteger('target');
            $table->bigInteger('s_price');
            $table->string('sp_type');
            $table->string('coupon')->nullable();
            $table->enum('type', ['campaign', 'coupon']);
            // $table->enum('image_type',['horizontal','vertical']);
            // $table->integer('percentage');
            $table->timestamp('start')->default(now()); // Set a default value for 'start'
            $table->timestamp('end')->default(now());   // Set a default value for 'end'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
