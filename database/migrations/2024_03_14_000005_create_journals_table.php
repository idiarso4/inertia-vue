<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users');
            $table->foreignId('supervisor_id')->constrained('users');
            $table->date('activity_date');
            $table->text('activity_description');
            $table->string('documentation')->nullable();
            $table->enum('status', ['draft', 'submitted', 'approved', 'rejected']);
            $table->text('supervisor_feedback')->nullable();
            $table->timestamp('validated_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('journals');
    }
}; 