<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Mpdf\Mpdf;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function UploadFile(Request $request,$name = null,$directory = 'uploads'){
        $result = null;
        if($name == null) return $result;
        if($request->hasFile($name)){
            $uploadName = Date('Ymdhis').$request->file($name)->getClientOriginalName();
            $upload = $request->file($name)->move($directory,$uploadName);
            $result = $uploadName;
        }
        return $result;
    }

    public function getLastKlasifikasi($resiko,$rencana_aksi,$anggaran){
        return ($resiko * 33 / 100) + ($rencana_aksi * 33 / 100) + ($anggaran * 34 / 100);
    }

    public function KelasResiko($kelas){
        switch($kelas){
            case 'Rendah':
                return 1;
            case 'Sedang':
                return 2;
            case 'Tinggi':
                return 3;
        }
    }

    

}
