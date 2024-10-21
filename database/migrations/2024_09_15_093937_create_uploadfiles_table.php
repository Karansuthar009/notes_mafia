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
        Schema::create('uploadfiles', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->string('file_path');
            $table->string('title');
            $table->string('description');
            $table->string('semester');
            $table->string('category');
            $table->string('course');
            $table->string('subject');
            $table->string('year');
            $table->string('username');
            $table->string('photo');
            $table->string('view')->default(Null);
            $table->string('collage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploadfiles');
    }
};
