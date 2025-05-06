<?php

namespace App\Http\Controllers;

use App\Models\BatasWilayahKecDesa;
use App\Models\TabulasiResikoBanjir;
use Illuminate\Http\Request;

class TabulasiResikoBanjirController extends Controller
{
    //
    public function index()
    {
        $data = BatasWilayahKecDesa::where('status', '=', '1')->latest()->get();
        return view('tabulasi_resiko.index', compact(['data']));
    }
    public function form(string $id)
    {
        $data = BatasWilayahKecDesa::findOrFail($id);
        return view('tabulasi_resiko.form', compact(['data','id']));
    }
    public function set(Request $request)
    {
        $oldData = TabulasiResikoBanjir::where('batas_wilayah_kec_desa_id', '=', $request->batas_wilayah_kec_desa_id)->first();
        $data = [
            'batas_wilayah_kec_desa_id' => $request->batas_wilayah_kec_desa_id,
            'lb_rendah' => $request->lb_rendah,
            'lb_sedang' => $request->lb_sedang,
            'lb_tinggi' => $request->lb_tinggi,
            'kelas' => $request->kelas,
        ];
        if (isset($oldData->id)) {
            if ($oldData->update($data)) {
                return redirect()->route('tabulasi_resiko')->with('success', 'Set Data Berhasil');
            }
            return redirect()->route('tabulasi_resiko')->with('error', 'Oops,Set data gagal karena ada kesalahan teknis. silahkan coba lagi !');
        }
        if (TabulasiResikoBanjir::insert($data)) {
            return redirect()->route('tabulasi_resiko')->with('success', 'Set Data Berhasil');
        }
        return redirect()->route('tabulasi_resiko')->with('error', 'Oops,Ada kesalahan teknis. silahkan coba lagi !');

    }
}
