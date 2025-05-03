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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('kursus_id')->constrained()->cascadeOnDelete();
            $table->string('diskon_kode')->nullable();
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->unsignedBigInteger('total_harga');
            $table->timestamps();

            $table->foreign('diskon_kode')->references('kode')->on('diskons')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
