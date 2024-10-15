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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('color_id')->nullable();
            $table->integer('size_id')->nullable();
            $table->string('image')->nullable();
            $table->bigInteger('total_qnt')->default(0);
            $table->bigInteger('qnt')->default(0);
            $table->timestamps();

            $table->foreign('color_id')->references('id')->on('colors')->onDelete('restrict');    // Restrict color deletion if it's in use
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
