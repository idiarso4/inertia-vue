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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->foreignId('class_room_id')->constrained()->onDelete('cascade');
            $table->dateTime('check_in_time');
            $table->dateTime('check_out_time')->nullable();
            $table->text('teaching_material');
            $table->text('teaching_method');
            $table->text('notes')->nullable();
            $table->string('documentation')->nullable();
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpha']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};