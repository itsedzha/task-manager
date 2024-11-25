<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('title'); // Task Title
            $table->text('description')->nullable(); // Task Description
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium'); // Priority
            $table->boolean('completed')->default(false); // Completion Status
            $table->date('deadline')->nullable(); // Deadline
            $table->timestamps(); // Created At & Updated At
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
