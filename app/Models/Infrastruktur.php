<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infrastruktur extends Model
{
    use HasFactory;
    protected $table = 'infrastrukturs';
    protected $fillable = [
        'kode_infrastruktur',
        'nama_infrastruktur',
        'style',
        'properties_show',
        'geojson_file',
        'status',
    ];
}
