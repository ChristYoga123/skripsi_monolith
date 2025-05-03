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
        Schema::create('kursuses', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->unique();
            $table->string('slug')->unique();
            $table->enum('kategori', ['programming', 'cyber-security', 'design', 'digital-marketing']);
            $table->longText('deskripsi');
            $table->json('keypoints');
            $table->enum('level', ['beginner', 'intermediate', 'advanced']);
            $table->enum('tipe', ['free', 'premium']);
            $table->unsignedBigInteger('harga')->default(0);
            $table->boolean('is_published')->default(false);
            $table->text('resource_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kursuses');
    }
};
