<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'reports';
    public $incrementing = false;

    public function images()
    {
        return $this->hasMany(ReportImage::class, 'report_id', 'id');
    }

    public function getVal($column){
        return $this[$column];
    }
}
