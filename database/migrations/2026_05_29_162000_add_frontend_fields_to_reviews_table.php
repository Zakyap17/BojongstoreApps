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
        Schema::table('reviews', function (Blueprint $table) {
            if (!Schema::hasColumn('reviews', 'user_name')) {
                $table->string('user_name')->nullable();
            }
            if (!Schema::hasColumn('reviews', 'comment')) {
                $table->text('comment')->nullable();
            }
            if (!Schema::hasColumn('reviews', 'product_id')) {
                $table->string('product_id')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn(['user_name', 'comment', 'product_id']);
        });
    }
};
