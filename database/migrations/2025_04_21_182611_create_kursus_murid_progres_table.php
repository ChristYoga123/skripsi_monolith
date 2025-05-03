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
        Schema::create('kursus_murid_progres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kursus_murid_id')->constrained()->cascadeOnDelete();
            $table->foreignId('kursus_bab_materi_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_current')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kursus_murid_progres');
    }
};
