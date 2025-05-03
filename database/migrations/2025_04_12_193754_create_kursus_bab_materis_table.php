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
        Schema::create('kursus_bab_materis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kursus_bab_id')->constrained()->cascadeOnDelete();
            $table->string('judul');
            $table->enum('tipe', ['video', 'text']);
            $table->text('youtube_url')->nullable();
            $table->longText('text')->nullable();
            $table->boolean('is_terkunci')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kursus_bab_materis');
    }
};
