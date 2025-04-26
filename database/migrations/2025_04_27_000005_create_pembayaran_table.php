<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tgl_pembayaran')->useCurrent();
            $table->integer('nominal');
            $table->string('layanan');
            $table->string('jns_pembayaran');
            $table->foreignId('id_dokter')->constrained('dokter')->onDelete('cascade');
            $table->foreignId('id_pasien')->constrained('pasien')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
