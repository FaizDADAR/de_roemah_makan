<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->integer('price');
            $table->string('category');
            $table->string('image_url');
            $table->boolean('available')->default(true);
            $table->boolean('is_best_seller')->default(false);
            $table->boolean('is_favorite')->default(false);
            $table->boolean('is_recommended')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
