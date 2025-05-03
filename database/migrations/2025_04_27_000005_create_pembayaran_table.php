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
            $table->unsignedBigInteger('pasien_id');
            $table->unsignedBigInteger('dokter_id');
            $table->timestamp('tgl_pembayaran')->useCurrent();
            $table->integer('nominal');
            $table->string('layanan');
            $table->string('jns_pembayaran');
            $table->timestamps();

            $table->foreign('pasien_id')->references('id')->on('pasien')->onDelete('cascade');
            $table->foreign('dokter_id')->references('id')->on('dokter')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
