<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('reviews')) {
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
        } else {
            Schema::table('reviews', function (Blueprint $table) {
                if (!Schema::hasColumn('reviews', 'product_name')) {
                    $table->string('product_name')->nullable();
                }
                if (!Schema::hasColumn('reviews', 'umkm_name')) {
                    $table->string('umkm_name')->nullable();
                }
                if (!Schema::hasColumn('reviews', 'reviewer_name')) {
                    $table->string('reviewer_name')->nullable();
                }
                if (!Schema::hasColumn('reviews', 'reviewer_initials')) {
                    $table->string('reviewer_initials', 4)->nullable();
                }
                if (!Schema::hasColumn('reviews', 'is_verified')) {
                    $table->boolean('is_verified')->default(false);
                }
                if (!Schema::hasColumn('reviews', 'content')) {
                    $table->text('content')->nullable();
                }
                if (!Schema::hasColumn('reviews', 'product_image')) {
                    $table->string('product_image')->nullable();
                }
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
