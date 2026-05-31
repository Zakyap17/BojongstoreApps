<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * NOTE: is_featured might already exist from migration 2026_05_12_140019.
     * Using conditional check to prevent duplicate column error.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('products', 'is_featured')) {
            Schema::table('products', function (Blueprint $table) {
                $table->boolean('is_featured')->default(false)->after('category_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('products', 'is_featured')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('is_featured');
            });
        }
    }
};
