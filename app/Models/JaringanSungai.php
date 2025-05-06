<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JaringanSungai extends Model
{
    use HasFactory;
    protected $table = 'jaringan_sungai';
    protected $fillable = [
        'kode_jaringan_sungai',
        'nama_jaringan_sungai',
        'geojson_file',
        'style',
        'status',
    ];
}
