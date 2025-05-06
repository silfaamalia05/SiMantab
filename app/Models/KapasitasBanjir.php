<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KapasitasBanjir extends Model
{
    use HasFactory;
    protected $table = 'kapasitas_banjirs';
    protected $fillable = [
        'batas_wilayah_kec_desa_id',
        'index_ketahanan_daerah',
        'index_kesiapsiagaan',
        'index_kapasitas',
    ];

    public function BatasWilayahKecDesa(){
        return $this->belongsTo(BatasWilayahKecDesa::class,'batas_wilayah_kec_desa_id');
    }
}
