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
        Schema::dropIfExists('subjects');

        // Create the table
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('teacher_id')->constrained('users');
            $table->timestamps();
        });

        // Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('subjects');
        Schema::enableForeignKeyConstraints();
    }
}; 