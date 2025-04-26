<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('antrian', function (Blueprint $table) {
            $table->id();
            $table->string('sts_antrian');
            $table->foreignId('id_poli')->constrained('poli')->onDelete('cascade');
            $table->foreignId('id_pasien')->constrained('pasien')->onDelete('cascade');
            $table->foreignId('id_dokter')->constrained('dokter')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antrian');
    }
};
