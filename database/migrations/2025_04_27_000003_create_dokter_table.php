<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokter', function (Blueprint $table) {
            $table->id();
            $table->string('spesialis');
            $table->string('no_hp');
            $table->string('nama_dokter');
            $table->string('email')->unique();
            $table->enum('sts_dokter', ['Tersedia', 'Tidak Tersedia']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokter');
    }
};
