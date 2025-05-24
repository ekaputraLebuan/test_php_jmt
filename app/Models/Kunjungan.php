<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Kunjungan extends Model
{
    protected $table = 'kunjungan';

    protected $fillable = ['nokunjungan', 'pasien_id', 'user_id', 'tglkunjungan', 'statusenabled'];

    public function pasien() {
        return $this->belongsTo(Pasien::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function pemeriksaanfisik() {
        return $this->hasOne(PemeriksaanFisik::class);
    }

    public function pemeriksaanmedis() {
        return $this->hasOne(PemeriksaanMedis::class);
    }

    public function resep()
    {
        return $this->hasMany(Resep::class);
    }

    public function getTanggalAttribute()
    {
        $hari = array ( 1 =>    'Senin',
                        'Selasa',
                        'Rabu',
                        'Kamis',
                        'Jumat',
                        'Sabtu',
                        'Minggu'
                    );
        return $hari[date('N', strtotime($this->tglkunjungan))] .', '. Carbon::createFromFormat('Y-m-d H:i:s', $this->tglkunjungan)->format('d/m/Y H:i:s');
    }

    public function getUmurAttribute()
    {
    
        return Carbon::parse($this->pasien->tgllahir)->diff(Carbon::parse($this->tglkunjungan))->format('%y thn, %m bln and %d hari');
    }

    public function getStatusKunjunganAttribute()
    {
        $text = '';
        if($this->status == 1) {
            $text = 'Antrian Perawat';
        } else if($this->status == 2) {
            $text = 'Antrian Dokter';
        } else if($this->status == 3) {
            $text = 'Antrian Resep';
        } else {
            $text = 'Pulang';
        }
    
        return $text;
    }

    public function getPersenStatusAttribute()
    {
        return ($this->status * 100) / 4 .'%';
    }

}
