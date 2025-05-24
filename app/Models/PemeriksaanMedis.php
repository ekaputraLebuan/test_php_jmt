<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanMedis extends Model
{
    protected $table = 'pemeriksaanmedis';
    protected $fillable = ['kunjungan_id', 'keluhanutama', 
                        'riwayatapenyakitsekarang', 
                        'riwayatapenyakitdahulu', 
                        'riwayatalergi', 'riwayatpemakaianobat', 
                        'diagnosautama', 'diagnosatambahan'];

    public function kunjungan() {
        return $this->belongsTo(Kunjungan::class);
    }
}
