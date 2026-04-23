<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catering_items', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('catering_id')->constrained()->onDelete('cascade');
            $blueprint->foreignId('menu_item_id')->constrained();
            $blueprint->string('name');
            $blueprint->integer('price');
            $blueprint->integer('qty');
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catering_items');
    }
};
