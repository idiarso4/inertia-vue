<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Disable foreign key checks
        Schema::disableForeignKeyConstraints();

        // Drop existing table
        Schema::dropIfExists('schedules');

        // Create the table
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('class_room_id')->constrained()->onDelete('cascade');
            $table->string('day');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('semester');
            $table->string('academic_year');
            $table->enum('status', ['active', 'inactive', 'cancelled'])->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();

            // Add indexes for better query performance
            $table->index(['day', 'start_time']);
            $table->index(['semester', 'academic_year']);
        });

        // Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('schedules');
        Schema::enableForeignKeyConstraints();
    }
};