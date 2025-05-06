<?php

namespace App\Http\Controllers;

use App\Models\BatasWilayahKecDesa;
use App\Models\PotensiPendudukTerpapar;
use Illuminate\Http\Request;

class PotensiPendudukTerpaparController extends Controller
{
    //
    public function index(){
        $data = BatasWilayahKecDesa::where('status','=','1')->latest()->get();
        return view('potensi_penduduk_terpapar.index',compact(['data']));
    }
    public function form(String $id){
        $data = BatasWilayahKecDesa::findOrFail($id);
        return view('potensi_penduduk_terpapar.form',compact(['data','id']));
    }
    public function set(Request $request){
        $oldData = PotensiPendudukTerpapar::where('batas_wilayah_kec_desa_id','=',$request->batas_wilayah_kec_desa_id)->first();
        $data = [
            'batas_wilayah_kec_desa_id' => $request->batas_wilayah_kec_desa_id,
            'penduduk_terpapar' => $request->penduduk_terpapar,
            'kelompok_umur_rentan' => $request->kelompok_umur_rentan,
            'penduduk_disabilitas' => $request->penduduk_disabilitas,
            'penduduk_miskin' => $request->penduduk_miskin,
        ];
        if(isset($oldData->id)){
            if($oldData->update($data)){
                return redirect()->route('potensi_penduduk_terpapar')->with('success','Set Data Berhasil');
            }
            return redirect()->route('potensi_penduduk_terpapar')->with('error','Oops,Set data gagal karena ada kesalahan teknis. silahkan coba lagi !');
        }
        if(PotensiPendudukTerpapar::insert($data)){
            return redirect()->route('potensi_penduduk_terpapar')->with('success','Set Data Berhasil');
        }
        return redirect()->route('potensi_penduduk_terpapar')->with('error','Oops,Ada kesalahan teknis. silahkan coba lagi !');
      }
}
