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
        Schema::create('product3d_models', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->string('slug')->unique();
            $table->json('badge')->nullable();
            $table->json('subtitle')->nullable();
            $table->json('description')->nullable();
            $table->string('glb_file');
            $table->string('thumbnail')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_initial')->default(false);
            $table->integer('sort_order')->default(0);
            $table->json('camera_settings')->nullable();
            $table->json('transform_settings')->nullable();
            $table->json('parts')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product3d_models');
    }
};
