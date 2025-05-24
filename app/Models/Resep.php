<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $table = 'resep';
    protected $fillable = ['kunjungan_id', 'obat_id', 'aturanpakai', 'keterangan'];

    public function kunjungan() {
        return $this->belongsTo(Kunjungan::class);
    }

    public function obat() {
        return $this->belongsTo(Obat::class);
    }
}
