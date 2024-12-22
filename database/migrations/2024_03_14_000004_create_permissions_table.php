<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users');
            $table->foreignId('subject_id')->constrained('subjects');
            $table->foreignId('class_room_id')->constrained('class_rooms');
            $table->text('reason');
            $table->string('proof_file')->nullable();
            $table->enum('status', ['pending', 'approved_by_teacher', 'rejected_by_teacher', 'approved_final', 'rejected_final']);
            $table->text('teacher_notes')->nullable();
            $table->text('supervisor_notes')->nullable();
            $table->timestamp('teacher_approved_at')->nullable();
            $table->timestamp('supervisor_approved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}; 