<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PotensiKerugian extends Model
{
    use HasFactory;
    protected $table = 'potensi_kerugians';
    protected $fillable = [
       'batas_wilayah_kec_desa_id',
        'kerugian_fisik',
        'kerugian_ekonomi',
        'potensi_kerusakan_lingkungan',
    ];
    public function BatasWilayahKecDesa(){
        return $this->belongsTo(BatasWilayahKecDesa::class,'batas_wilayah_kec_desa_id');
    }
}
