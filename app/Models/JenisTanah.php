<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisTanah extends Model
{
    use HasFactory;
    protected $table = 'jenis_tanah';
    protected $fillable = [
       'kode_jenis_tanah',
       'nama_jenis_tanah',
       'geojson_file',
       'style',
       'status',
    ];
}
