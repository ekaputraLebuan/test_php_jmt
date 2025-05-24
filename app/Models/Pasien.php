<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Pasien extends Model
{
    protected $table = 'pasien';

    protected $fillable = ['norm', 'namapasien', 'tempatlahir', 'tgllahir', 
                        'jeniskelamin', 'alamat', 'nohp', 'golongandarah', 
                        'statusenabled'];


    public function scopeList($query)
    {
        return $query->where('statusenabled', true)->orderBy('namapasien');
    }

    public function kunjungan()
    {
        return $this->hasMany(Kunjungan::class);
    }

    public function getTtlAttribute()
    {
        return $this->tempatlahir .', '. Carbon::createFromFormat('Y-m-d', $this->tgllahir)->format('d/m/Y');
    }

    public function getGenderAttribute()
    {
        if($this->jeniskelamin == 'Perempuan') {
            return "P";
        } else {
            return "L";
        }
        
    }

    public function getIconGenderAttribute()
    {
        if($this->jeniskelamin == 'Perempuan') {
            return '<i class="bi bi-gender-female text-danger"></i>';
        } else {
            return '<i class="bi bi-gender-male text-danger"></i>';
        }
        
    }

    public function getImageAttribute()
    {
        if($this->jeniskelamin == 'Perempuan') {
            return asset('template/media/avatars/pw.png');;
        } else {
            return asset('template/media/avatars/pm.png');
        }
    }
}
