<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBanjir extends Model
{
    use HasFactory;
    protected $table = 'data_banjirs';
    protected $fillable = [
        'kode_data',
       'nama_data',
     
       'geojson_file',
       'properties_show',
       'status',
    ];
}
