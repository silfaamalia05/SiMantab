<?php

namespace App\Http\Controllers;

use App\Models\Kelerengan;
use Illuminate\Http\Request;

class KelerenganController extends Controller
{
  /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Kelerengan::latest()->get();
        return view('base_layer.kelerengan.index',compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('base_layer.kelerengan.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = \Validator::make($request->all(),[
            'kode_kelerengan' => ['required'],
            'nama_kelerengan' => ['required'],
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
            'kode_kelerengan' => $request->kode_kelerengan,
            'nama_kelerengan'=> $request->nama_kelerengan, 
            'geojson_file'=> $upload,
            'style'=> $request->style,
            'status'=> $request->status,
        ];
        if(Kelerengan::insert($data)){
            return redirect()->route('kelerengan.index')->with('success','Input Data Berhasil');
        }
        return redirect()->route('kelerengan.index')->with('error','Oops,Ada kesalahan teknis. silahkan coba lagi !');
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
        $data = Kelerengan::findOrFail($id);
        return view('base_layer.kelerengan.form',compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $oldData = Kelerengan::findOrFail($id);
        $validate = \Validator::make($request->all(),[
            'kode_kelerengan' => ['required'],
            'nama_kelerengan' => ['required'],
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
            'kode_kelerengan' => $request->kode_kelerengan,
            'nama_kelerengan'=> $request->nama_kelerengan, 
            'geojson_file'=> $upload,
            'style'=> $request->style,
            'status'=> $request->status,
        ];
        if($oldData->update($data)){
            return redirect()->route('kelerengan.index')->with('success','Update Data Berhasil');
        }
        return redirect()->route('kelerengan.index')->with('error','Oops,Ada kesalahan teknis. silahkan coba lagi !');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Kelerengan::findOrFail($id);
        if(file_exists('uploads/geojson/'.$data->geojson_file)){
            unlink('uploads/geojson/'.$data->geojson_file);
        }
        $data->delete();
        return redirect()->route('kelerengan.index')->with('success','Hapus Data Berhasil');
   
    }
}
