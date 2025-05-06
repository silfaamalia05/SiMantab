<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatasWilayahKabKota extends Model
{
    use HasFactory;

    protected $table = 'batas_wilayah_kab_kotas';
    protected $fillable = [
        'KDPKAB',
        'WADMKK',
        'geojson_file',
        'style',
        'status',
    ];

    public function BatasWilayahKecDesa(){
        return $this->hasMany(BatasWilayahKecDesa::class);
    }

}
