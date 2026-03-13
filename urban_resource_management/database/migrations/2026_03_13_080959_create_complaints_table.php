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
        Schema::create('complaint_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

        Schema::create('complaints', function (Blueprint $table) {
            $table->id();

            $table->string('address')->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();
            $table->text('description');
            $table->enum('dump_size', ['pequeño', 'mediano', 'grande']);
            $table->foreignId('citizen_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('photo_path')->nullable();
            $table->foreignId('complaint_status_id')
                ->constrained('complaint_statuses')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->date('complaint_date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_statuses');
        Schema::dropIfExists('complaints');
    }
};
