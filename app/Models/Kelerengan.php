<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelerengan extends Model
{
    use HasFactory;
    protected $table = 'kelerengan';
    protected $fillable = [
        'kode_kelerengan',
        'nama_kelerengan',
        'geojson_file',
        'style',
        'status',
    ];
}
