<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('umkm_name')->nullable();
            $table->string('reviewer_name');
            $table->string('reviewer_initials', 4)->nullable();
            $table->boolean('is_verified')->default(false);
            $table->tinyInteger('rating')->default(5); // 1-5
            $table->text('content');
            $table->string('product_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
