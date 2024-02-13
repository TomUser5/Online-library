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
        Schema::create('read_materials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('location');
            $table->foreignId('type_material_id')->constrained();
            $table->foreignId('subject_id')->constrained();
            $table->foreignId('class_id')->constrained();
            $table->foreignId('author_id')->constrained();
            $table->foreignId('teacher_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('read_materials');
    }
};
