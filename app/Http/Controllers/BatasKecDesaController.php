<?php

namespace App\Http\Controllers;

use App\Models\BatasWilayahKabKota;
use App\Models\BatasWilayahKecDesa;
use Illuminate\Http\Request;

class BatasKecDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = BatasWilayahKecDesa::latest()->get();
        return view('base_layer.kec_desa.index',compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $kab_kota = BatasWilayahKabKota::where('status','=','1')->get();
        return view('base_layer.kec_desa.form',compact(['kab_kota']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = \Validator::make($request->all(),[
            'batas_wilayah_kab_kota_id' => ['required'],
            'KDCPUM' => ['required'],
            'WADMKC' => ['required'],
            'geojson_file' => ['required'],
            'status' => ['required'],
        ]);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $ext = $request->file('geojson_file')->getClientOriginalExtension();
        if($ext != 'geojson'){
            return redirect()->back()->with('error','File harus berekstensi Geojson (.geojson)');
        }
        $upload = $this->UploadFile($request,'geojson_file','uploads/geojson');
        $data = [
            'batas_wilayah_kab_kota_id' => $request->batas_wilayah_kab_kota_id,
            'KDCPUM'=> $request->KDCPUM,
            'WADMKC'=> $request->WADMKC,
            'geojson_file'=> $upload,
            'style'=> $request->style,
            'status'=> $request->status,
        ];
        if(BatasWilayahKecDesa::insert($data)){
            return redirect()->route('batas_kec_desa.index')->with('success','Input Data Berhasil');
        }
        return redirect()->route('batas_kec_desa.index')->with('error','Oops,Ada kesalahan teknis. silahkan coba lagi !');
    
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
        $data = BatasWilayahKecDesa::findOrFail($id);
        $kab_kota = BatasWilayahKabKota::where('status','=','1')->get();
        return view('base_layer.kec_desa.form',compact(['kab_kota','data']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $oldData = BatasWilayahKecDesa::findOrFail($id);
        $validate = \Validator::make($request->all(),[
            'batas_wilayah_kab_kota_id' => ['required'],
            'KDCPUM' => ['required'],
            'WADMKC' => ['required'],
            'status' => ['required'],
        ]);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $upload = $oldData->geojson_file;
        if($request->hasFile('geojson_file')){
            $ext = $request->file('geojson_file')->getClientOriginalExtension();
            if($ext != 'geojson'){
                return redirect()->back()->with('error','File harus berekstensi Geojson (.geojson)');
            }
            $upload = $this->UploadFile($request,'geojson_file','uploads/geojson');
            if(file_exists('uploads/geojson/'.$oldData->geojson_file)){
                unlink('uploads/geojson/'.$oldData->geojson_file);
            }
        }
        $data = [
            'batas_wilayah_kab_kota_id' => $request->batas_wilayah_kab_kota_id,
            'KDCPUM'=> $request->KDCPUM,
            'WADMKC'=> $request->WADMKC,
            'geojson_file'=> $upload,
            'style'=> $request->style,
            'status'=> $request->status,
        ];
        if($oldData->update($data)){
            return redirect()->route('batas_kec_desa.index')->with('success','Update Data Berhasil');
        }
        return redirect()->route('batas_kec_desa.index')->with('error','Oops,Ada kesalahan teknis. silahkan coba lagi !');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = BatasWilayahKecDesa::findOrFail($id);
        if(file_exists('uploads/geojson/'.$data->geojson_file)){
            unlink('uploads/geojson/'.$data->geojson_file);
        }
        $data->delete();
        return redirect()->route('batas_kec_desa.index')->with('success','Hapus Data Berhasil');
    
    }
}
