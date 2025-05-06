<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class ReportImage extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $incrementing = false;
    protected $table = 'report_images';

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
    public function getImages(string $path){
      
        return Storage::url($path);
    }
}
