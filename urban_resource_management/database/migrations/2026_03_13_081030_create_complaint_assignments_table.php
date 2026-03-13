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
        Schema::create('cleaning_staff', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('phone')->nullable();
            $table->boolean('available')->default(true);
            $table->foreignId('status_id')
                ->constrained('statuses')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->timestamps();
        });

        Schema::create('complaint_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->date('scheduled_date');
            $table->string('estimated_resources')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
        });

        Schema::create('assignment_staff', function (Blueprint $table) {

            $table->id();

            $table->foreignId('complaint_assignment_id')
                ->constrained('complaint_assignments')
                ->cascadeOnDelete();

            $table->foreignId('cleaning_staff_id')
                ->constrained('cleaning_staff')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_staff');
        Schema::dropIfExists('complaint_assignments');
        Schema::dropIfExists('cleaning_staff');
    }
};
