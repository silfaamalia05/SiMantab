<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Morfologi extends Model
{
    use HasFactory;
    protected $table = 'morfologi';
    protected $fillable = [
       'kode_morfologi',
       'nama_morfologi',
       'geojson_file',
       'style',
       'status',
    ];
}
