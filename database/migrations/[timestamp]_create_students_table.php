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
        Schema::dropIfExists('students');

        // Create the table
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nis')->unique();
            $table->foreignId('class_room_id')->constrained()->onDelete('cascade');
            $table->enum('gender', ['L', 'P']);
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('religion')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('parent_name')->nullable();
            $table->string('parent_phone')->nullable();
            $table->text('parent_address')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();

            // Add indexes for better query performance
            $table->index('nis');
            $table->index(['birth_place', 'birth_date']);
        });

        // Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('students');
        Schema::enableForeignKeyConstraints();
    }
}; 