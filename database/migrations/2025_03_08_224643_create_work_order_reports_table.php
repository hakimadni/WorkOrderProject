<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('work_order_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('operator_id')->constrained('users')->onDelete('cascade');
            $table->string('product_name');
            $table->integer('completed_quantity');
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_order_reports');
    }
};
