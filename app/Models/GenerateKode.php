<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenerateKode extends Model
{
    protected $table = 'generatekode';

    protected $fillable = ['type', 'name'];
}
