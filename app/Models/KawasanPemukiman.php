<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KawasanPemukiman extends Model
{
    use HasFactory;
    protected $table = 'kawasan_pemukiman';
    protected $fillable = [
        'kode_kawasan_pemukiman',
        'nama_kawasan_pemukiman',
        'geojson_file',
        'style',
        'status',
    ];
}
