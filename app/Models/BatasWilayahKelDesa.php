<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatasWilayahKelDesa extends Model
{
    use HasFactory;
    protected $table = 'batas_wilayah_kel_desa';

    protected $fillable = [
        'kode_batas',
        'nama_batas',
        'geojson_file',
        'style',
        'status',
    ];

}
