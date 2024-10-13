<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('name');
            $table->string('sku', 255)->unique()->nullable();
            $table->string('slugs')->unique();
            $table->text('short_description', 3000);
            $table->longText('description');
            $table->longText('additional_info')->nullable();
            $table->string('video_link')->nullable();
            $table->decimal('stock_price', 10.0)->default(0);
            $table->decimal('price', 10.0)->default(0);
            $table->integer('s_price')->default(0);
            $table->enum('sp_type', ['Fixed', 'Percent']);
            $table->integer('featured')->default(0);
            $table->integer('popular')->default(0);
            $table->integer('shipping_fee')->default(0);
            $table->enum('status', ['active', 'deactive']);
            $table->string('seo_title')->nullable();
            $table->text('seo_description', 1000)->nullable();
            $table->string('seo_tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
