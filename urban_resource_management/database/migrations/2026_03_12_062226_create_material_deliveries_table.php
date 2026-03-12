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
        Schema::create('material_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('green_point_id')
                ->constrained();
            $table->foreignId('container_id')
                ->constrained();
            $table->decimal('quantity_kg',8,2);
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('citizen_code')
                ->nullable();
            $table->timestamp('delivered_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_deliveries');
    }
};
