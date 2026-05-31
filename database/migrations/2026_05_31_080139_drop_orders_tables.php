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
        // Drop order_items first due to FK constraint
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop order_items first due to FK constraint
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
