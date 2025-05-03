<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'Jadwal';

    protected $fillable = ['dokter_id', 'hari', 'jam'];

    public function dokter() {
        return $this->belongsTo(Dokter::class);
    }
}

