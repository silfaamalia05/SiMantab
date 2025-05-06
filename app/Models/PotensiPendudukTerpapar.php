<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PotensiPendudukTerpapar extends Model
{
    use HasFactory;
    protected $table = 'potensi_penduduk_terpapars'; 
    protected $fillable = [
        'batas_wilayah_kec_desa_id',
        'penduduk_terpapar',
        'kelompok_umur_rentan',
        'penduduk_disabilitas',
        'penduduk_miskin',
    ];
    public function BatasWilayahKecDesa(){
        return $this->belongsTo(BatasWilayahKecDesa::class,'batas_wilayah_kec_desa_id');
    }
}
