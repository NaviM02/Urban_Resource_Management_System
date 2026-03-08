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
        Schema::create('collection_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
        });

        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_status_id')
                ->constrained('collection_statuses')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('route_id')
                ->constrained('routes')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('truck_id')
                ->constrained('trucks')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->date('scheduled_date');
            $table->time('started_at')->nullable();
            $table->time('finished_at')->nullable();
            $table->decimal('estimated_waste_kg', 8, 2)->nullable();
            $table->string('observations')->nullable();

            $table->timestamps();
        });

        Schema::create('collection_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_id')
                ->constrained('collections')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->decimal('estimated_kg', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_points');
        Schema::dropIfExists('collections');
        Schema::dropIfExists('collection_statuses');
    }
};
