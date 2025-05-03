<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rme', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasien_id');
            $table->unsignedBigInteger('poli_id');
            $table->unsignedBigInteger('dokter_id');
            $table->string('keluhan');
            $table->string('resep_obat');
            $table->string('penyakit');
            $table->timestamp('tgl_daftar')->useCurrent();
            $table->timestamps();

            $table->foreign('pasien_id')->references('id')->on('pasien')->onDelete('cascade');
            $table->foreign('poli_id')->references('id')->on('poli')->onDelete('cascade');
            $table->foreign('dokter_id')->references('id')->on('dokter')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rme');
    }
};
