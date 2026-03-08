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
        Schema::create('truck_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

        Schema::create('trucks', function (Blueprint $table) {
            $table->id();
            $table->string('plate');
            $table->decimal('capacity_tons', 5, 2);
            $table->foreignId('truck_status_id')
                ->constrained('truck_statuses')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->string('driver_name');
            $table->foreignId('status_id')
                ->constrained('statuses')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trucks');
        Schema::dropIfExists('truck_statuses');
    }
};
