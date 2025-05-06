<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatasWilayahKecDesa extends Model
{
    use HasFactory;
    protected $table = 'batas_wilayah_kec_desas';
    protected $fillable = [
        'batas_wilayah_kab_kota_id',
        'KDCPUM',
        'WADMKC',
        'geojson_file',
        'style',
        'status',
    ];
    public function KapasitasBanjir(){
        return $this->hasOne(KapasitasBanjir::class);
    }
    public function PotensiKerugian(){
        return $this->hasOne(PotensiKerugian::class);
    }
    public function PotensiPendudukTerpapar(){
        return $this->hasOne(PotensiPendudukTerpapar::class);
    }
    public function TabulasiBahayaBanjir(){
        return $this->hasOne(TabulasiBahayaBanjir::class);
    }
    public function TabulasiResikoBanjir(){
        return $this->hasOne(TabulasiResikoBanjir::class);
    }

    public function BatasWilayahKabKota(){
        return $this->belongsTo(BatasWilayahKabKota::class,'batas_wilayah_kab_kota_id');
    }
}
