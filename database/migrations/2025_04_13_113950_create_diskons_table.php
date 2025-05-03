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
        Schema::create('diskons', function (Blueprint $table) {
            $table->id();
            // flash sale
            $table->foreignId('kursus_id')->nullable()->constrained()->cascadeOnDelete();
            // kode diskon
            $table->string('kode')->nullable()->unique();
            $table->enum('jenis', ['dibatasi_tanggal', 'dibatasi_kuota'])->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->unsignedInteger('kuota')->nullable();

            $table->unsignedInteger('persentase');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diskons');
    }
};
