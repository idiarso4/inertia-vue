<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('teacher_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('education')->nullable();
            $table->string('expertise')->nullable();
            $table->date('join_date')->nullable();
            $table->string('employment_status')->nullable(); // PNS/Honorer/dll
            $table->string('certification_number')->nullable();
            $table->year('certification_year')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teacher_details');
    }
}; 