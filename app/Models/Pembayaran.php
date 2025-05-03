<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = ['pasien_id', 'dokter_id', 'tgl_pembayaran', 'nominal', 'layanan', 'jns_pembayaran'];

    public function pasien() {
        return $this->belongsTo(Pasien::class);
    }

    public function dokter() {
        return $this->belongsTo(Dokter::class);
    }
}

