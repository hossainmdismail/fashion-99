<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('version')->nullable();
            $table->string('image')->nullable();
            $table->boolean('default')->default(true);
            $table->timestamps();
        });

        // Array of data to insert
        $categories = [
            [
                'name'      => 'Default Theme',
                'slug'      => 'default',
                'version'   => '1.0.0',
                'image'     => 'thumbnail.webp',
                'default'   => true,
            ],
        ];
        // Insert all data at once
        DB::table('themes')->insert($categories);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('themes');
    }
};
