<?php

namespace App\Http\Controllers;

use App\Models\KategoriLogistik;
use App\Models\Logistik;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Validator;

class LogistikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Logistik::latest()->get();
        return view('logistik.index',compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $kategori = KategoriLogistik::latest()->get();
        return view('logistik.form',compact(['kategori']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = Validator::make($request->all(),[
            'jenis_alat' => ['required'],
            'merk' => ['required'],
            'model' => ['required'],
            'type' => ['required'],
            'kapasitas' => ['required'],
            'jumlah' => ['required'],
            'lokasi' => ['required']
        ]);
        if($validate->fails()){
            return redirect()->back()->with('error',$validate->errors()->messages())->withInput();
        }
        $insert = Logistik::insert([
            'jenis_alat' => $request->jenis_alat,
            'merk' => $request->merk,
            'model' => $request->model,
            'type' => $request->type,
            'kapasitas' => $request->kapasitas,
            'jumlah' => $request->jumlah,
            'kondisi_baik' => $request->kondisi_baik,
            'kondisi_rusak_ringan' => $request->kondisi_rusak_ringan,
            'kondisi_rusak_berat' => $request->kondisi_rusak_berat,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'kategori_logistik_id' => $request->kategori_logistik_id
        ]);
        if($insert){
            return redirect()->route('logistik.index')->with('success','Input data berhasil !');
        }
        return redirect()->route(route: 'logistik.index')->with('error','Oops,Ada kesalahan teknis. silahkan coba lagi !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $kategori = KategoriLogistik::latest()->get();
        $data = Logistik::findOrFail($id);
        return view('logistik.form',compact(['data','kategori']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $oldData = Logistik::findOrFail($id);
        $validate = Validator::make($request->all(),[
            'jenis_alat' => ['required'],
            'merk' => ['required'],
            'model' => ['required'],
            'type' => ['required'],
            'kapasitas' => ['required'],
            'jumlah' => ['required'],
            'lokasi' => ['required']
        ]);
        if($validate->fails()){
            return redirect()->back()->with('error',$validate->errors()->messages())->withInput();
        }
        $update = $oldData->update([
            'jenis_alat' => $request->jenis_alat,
            'merk' => $request->merk,
            'model' => $request->model,
            'type' => $request->type,
            'kapasitas' => $request->kapasitas,
            'jumlah' => $request->jumlah,
            'kondisi_baik' => $request->kondisi_baik,
            'kondisi_rusak_ringan' => $request->kondisi_rusak_ringan,
            'kondisi_rusak_berat' => $request->kondisi_rusak_berat,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'kategori_logistik_id' => $request->kategori_logistik_id
        ]);
        if($update){
            return redirect()->route('logistik.index')->with('success','Update data berhasil !');
        }
        return redirect()->route(route: 'logistik.index')->with('error','Oops,Ada kesalahan teknis. silahkan coba lagi !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Logistik::findOrFail($id);
        $data->delete();
        return redirect()->route('logistik.index')->with('success','Hapus data berhasil !');
    }
    public function print(Request $request){
       $data = Logistik::latest()->get();
       $kategori = KategoriLogistik::latest()->get();
       $pdf = Pdf::loadView('logistik.template.laporan',compact(['data','kategori']))->setPaper('A4','landscape');
       $pdf->setOption(['dpi' => 150,'defaultFont' => 'sans-serif']);
       
       return $pdf->stream();

    }
   
}
