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
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('zone_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('waste_type_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('status_id')
                ->constrained('statuses')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->decimal('lat_start', 10, 7);
            $table->decimal('lng_start', 10, 7);

            $table->decimal('lat_end', 10, 7);
            $table->decimal('lng_end', 10, 7);

            $table->json('path_coordinates')->nullable();

            $table->decimal('distance_km', 8, 2)->nullable();

            $table->string('collection_days', 7);
            // example: 1010100 (Monday, Wednesday, Friday)

            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
