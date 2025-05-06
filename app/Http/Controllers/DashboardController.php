<?php

namespace App\Http\Controllers;

use App\Models\BatasWilayahKelDesa;
use App\Models\JaringanSungai;
use App\Models\JenisTanah;
use App\Models\KawasanPemukiman;
use App\Models\Kelerengan;
use App\Models\Morfologi;
use App\Models\Report;
use App\Models\BatasWilayahKabKota;
use App\Models\BatasWilayahKecDesa;
use App\Models\DataBanjir;
use App\Models\Infrastruktur;
class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua laporan dari database
        $reports = Report::all();
        $batas_kab_kota = BatasWilayahKabKota::where('status','=','1')->latest()->get();
        $batas_kec_desa = BatasWilayahKecDesa::where('status','=','1')->latest()->get();
        $batas_kel_desa = BatasWilayahKelDesa::where('status','=','1')->latest()->get();
        $jaringan_sungai = JaringanSungai::where('status','=','1')->latest()->get();
        $jenis_tanah = JenisTanah::where('status','=','1')->latest()->get();
        $morfologi = Morfologi::where('status','=','1')->latest()->get();
        $kelerengan = Kelerengan::where('status','=','1')->latest()->get();
        $kawasan_pemukiman = KawasanPemukiman::where('status','=','1')->latest()->get();
        
        $infrastruktur = Infrastruktur::where('status','=','1')->latest()->get();
        $data_banjir = DataBanjir::where('status','=','1')->latest()->get();
        $reports = Report::all()->groupBy(function ($report) {
            return $report->skala_prioritas >= 2.5 ? 'Skala Prioritas 1' : 'Skala Prioritas 2';
        })->sortKeys();
        // Kirim data ke view
        return view('dashboard', compact(['reports','jaringan_sungai','jenis_tanah','morfologi','kelerengan','kawasan_pemukiman','reports','batas_kab_kota','batas_kec_desa','batas_kel_desa','infrastruktur','data_banjir']));
    }
}