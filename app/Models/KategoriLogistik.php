<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriLogistik extends Model
{
    use HasFactory;
    protected $table ='kategori_logistik';
    protected $fillable = [
        'name',
        'created_at',
        'updated_at'
    ];

    public function Logistik(){
        return $this->hasMany(Logistik::class);
    }

}
