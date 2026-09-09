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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('client')->nullable();
            $table->string('year')->nullable();
            $table->string('category')->default('Web Design');
            $table->text('short_description')->nullable();
            $table->text('full_description')->nullable();
            $table->string('cover_image');
            $table->string('mockup_image')->nullable();
            $table->json('gallery')->nullable();
            $table->json('tags')->nullable();
            $table->string('link_url')->nullable();
            $table->boolean('is_featured')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
