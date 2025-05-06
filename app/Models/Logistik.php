<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logistik extends Model
{
    use HasFactory;

    protected $table = 'logistik';

    protected $fillable = [
        'jenis_alat',
        'merk',
        'model',
        'type',
        'kapasitas',
        'jumlah',
        'kondisi_baik',
        'kondisi_rusak_ringan',
        'kondisi_rusak_berat',
        'lokasi',
        'keterangan',
        'kategori_logistik_id',
     ];

    public function KategoriLogistik(){
        return $this->belongsTo(KategoriLogistik::class,'kategori_logistik_id');
    }

}
