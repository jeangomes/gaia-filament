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
        Schema::create('favorite_links', function (Blueprint $table) {
            $table->id();
            $table->string('url'); // endereço do site
            $table->string('title')->nullable(); // nome amigável do link
            $table->text('description')->nullable(); // opcional
            $table->string('category')->nullable(); // opcional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorite_links');
    }
};
