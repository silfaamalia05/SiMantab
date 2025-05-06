<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabulasiBahayaBanjir extends Model
{
    use HasFactory;
    protected $table = 'tabulasi_bahaya_banjirs';
    protected $fillable = [
       'batas_wilayah_kec_desa_id',
            'lb_rendah',
            'lb_sedang',
            'lb_tinggi',
            'kelas',
    ];
    public function BatasWilayahKecDesa(){
        return $this->belongsTo(BatasWilayahKecDesa::class,'batas_wilayah_kec_desa_id');
    }
}
