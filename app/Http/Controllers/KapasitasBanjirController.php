<?php

namespace App\Http\Controllers;

use App\Models\BatasWilayahKecDesa;
use App\Models\KapasitasBanjir;
use Illuminate\Http\Request;

class KapasitasBanjirController extends Controller
{
    //
    public function index(){
        $data = BatasWilayahKecDesa::where('status','=','1')->latest()->get();
        return view('kapasitas_banjir.index',compact(['data']));
    }
    public function form(String $id){
        $data = BatasWilayahKecDesa::findOrFail($id);
        return view('kapasitas_banjir.form',compact(['data','id']));
    }
    public function set(Request $request){
        $oldData = KapasitasBanjir::where('batas_wilayah_kec_desa_id','=',$request->batas_wilayah_kec_desa_id)->first();
        $validate = \Validator::make($request->all(),[
            'batas_wilayah_kec_desa_id' => ['required'],
            'index_ketahanan_daerah' => ['required'],
            'index_kesiapsiagaan' => ['required'],
            'index_kapasitas' => ['required'],
        ]);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $data = [
            'batas_wilayah_kec_desa_id' => $request->batas_wilayah_kec_desa_id,
            'index_ketahanan_daerah' => $request->index_ketahanan_daerah,
            'index_kesiapsiagaan' => $request->index_kesiapsiagaan,
            'index_kapasitas' => $request->index_kapasitas,
        ];
        if(isset($oldData->id)){
            if($oldData->update($data)){
                return redirect()->route('kapasitas_banjir')->with('success','Set Data Berhasil');
            }
            return redirect()->route('kapasitas_banjir')->with('error','Oops,Set data gagal karena ada kesalahan teknis. silahkan coba lagi !');
        }
        if(KapasitasBanjir::insert($data)){
            return redirect()->route('kapasitas_banjir')->with('success','Set Data Berhasil');
        }
        return redirect()->route('kapasitas_banjir')->with('error','Oops,Ada kesalahan teknis. silahkan coba lagi !');
    }
}
