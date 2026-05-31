<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Adds extra product fields from main branch.
     * Using hasColumn checks to prevent duplicate column errors.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'weight')) {
                $table->string('weight')->nullable();
            }
            if (!Schema::hasColumn('products', 'type')) {
                $table->string('type')->nullable();
            }
            if (!Schema::hasColumn('products', 'packaging')) {
                $table->string('packaging')->nullable();
            }
            if (!Schema::hasColumn('products', 'shelf_life')) {
                $table->string('shelf_life')->nullable();
            }
            if (!Schema::hasColumn('products', 'production')) {
                $table->string('production')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['weight', 'type', 'packaging', 'shelf_life', 'production']);
        });
    }
};
