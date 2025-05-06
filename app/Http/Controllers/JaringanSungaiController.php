<?php

namespace App\Http\Controllers;

use App\Models\JaringanSungai;
use Illuminate\Http\Request;

class JaringanSungaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = JaringanSungai::latest()->get();
        return view('base_layer.jaringan_sungai.index',compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('base_layer.jaringan_sungai.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = \Validator::make($request->all(),[
            'kode_jaringan_sungai' => ['required'],
            'nama_jaringan_sungai' => ['required'],
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
            'kode_jaringan_sungai' => $request->kode_jaringan_sungai,
            'nama_jaringan_sungai'=> $request->nama_jaringan_sungai, 
            'geojson_file'=> $upload,
            'style'=> $request->style,
            'status'=> $request->status,
        ];
        if(JaringanSungai::insert($data)){
            return redirect()->route('jaringan_sungai.index')->with('success','Input Data Berhasil');
        }
        return redirect()->route('jaringan_sungai.index')->with('error','Oops,Ada kesalahan teknis. silahkan coba lagi !');
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
        $data = JaringanSungai::findOrFail($id);
        return view('base_layer.jaringan_sungai.form',compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $oldData = JaringanSungai::findOrFail($id);
        $validate = \Validator::make($request->all(),[
            'kode_jaringan_sungai' => ['required'],
            'nama_jaringan_sungai' => ['required'],
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
            'kode_jaringan_sungai' => $request->kode_jaringan_sungai,
            'nama_jaringan_sungai'=> $request->nama_jaringan_sungai, 
            'geojson_file'=> $upload,
            'style'=> $request->style,
            'status'=> $request->status,
        ];
        if($oldData->update($data)){
            return redirect()->route('jaringan_sungai.index')->with('success','Update Data Berhasil');
        }
        return redirect()->route('jaringan_sungai.index')->with('error','Oops,Ada kesalahan teknis. silahkan coba lagi !');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = JaringanSungai::findOrFail($id);
        if(file_exists('uploads/geojson/'.$data->geojson_file)){
            unlink('uploads/geojson/'.$data->geojson_file);
        }
        $data->delete();
        return redirect()->route('jaringan_sungai.index')->with('success','Hapus Data Berhasil');
   
    }
}
