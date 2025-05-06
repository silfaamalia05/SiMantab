<?php

namespace App\Http\Controllers;

use App\Models\BatasWilayahKecDesa;
use App\Models\PotensiKerugian;
use Illuminate\Http\Request;

class PotensiKerugianController extends Controller
{
    //
    public function index(){
        $data = BatasWilayahKecDesa::where('status','=','1')->latest()->get();
        return view('potensi_kerugian.index',compact(['data']));
    }
    public function form(String $id){
        $data = BatasWilayahKecDesa::findOrFail($id);
        return view('potensi_kerugian.form',compact(['data','id']));
    }
    public function set(Request $request){
        $oldData = PotensiKerugian::where('batas_wilayah_kec_desa_id','=',$request->batas_wilayah_kec_desa_id)->first();
        $data = [
            'batas_wilayah_kec_desa_id' => $request->batas_wilayah_kec_desa_id,
            'kerugian_fisik' => $request->kerugian_fisik,
            'kerugian_ekonomi' => $request->kerugian_ekonomi,
            'potensi_kerusakan_lingkungan' => $request->potensi_kerusakan_lingkungan,
        ];
        if(isset($oldData->id)){
            if($oldData->update($data)){
                return redirect()->route('potensi_kerugian')->with('success','Set Data Berhasil');
            }
            return redirect()->route('potensi_kerugian')->with('error','Oops,Set data gagal karena ada kesalahan teknis. silahkan coba lagi !');
        }
        if(PotensiKerugian::insert($data)){
            return redirect()->route('potensi_kerugian')->with('success','Set Data Berhasil');
        }
        return redirect()->route('potensi_kerugian')->with('error','Oops,Ada kesalahan teknis. silahkan coba lagi !');
    }
}
