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
        Schema::create('poster_category', function (Blueprint $table) {
            $table->unsignedBigInteger('poster_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('poster_id')
                ->references('id')
                ->on('posters')
                ->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poster_categories');
    }
};
