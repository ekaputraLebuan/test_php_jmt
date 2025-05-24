<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'obat';
    protected $fillable = ["namaobat","statusenablde"];

    public function scopeList($query)
    {
        return $query->where('statusenabled', true)->orderBy('namaobat');
    }

    public function resep()
    {
        return $this->hasMany(Resep::class);
    }

    public function getStatusAttribute()
    {
        if($this->statusenabled == true) {
            return '<span class="badge badge-light-success">Enable</span>';
        } else {
            return '<span class="badge badge-light-danger">Disable</span>';
        }
        
    }
}
