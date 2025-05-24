<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanFisik extends Model
{
    protected $table = 'pemeriksaanfisik';
    protected $fillable = ['kunjungan_id', 'beratbadan', 'tinggibadan', 'tekanandarah', 
                        'nadi', 'suhutubuh', 'saturasioksigen', 'imt'];

    public function kunjungan() {
        return $this->belongsTo(Kunjungan::class);
    }
}
