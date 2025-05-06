<?php

namespace App\Http\Controllers;

use App\Models\JenisTanah;
use Illuminate\Http\Request;

class JenisTanahController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = JenisTanah::latest()->get();
        return view('base_layer.jenis_tanah.index',compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('base_layer.jenis_tanah.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = \Validator::make($request->all(),[
            'kode_jenis_tanah' => ['required'],
            'nama_jenis_tanah' => ['required'],
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
            'kode_jenis_tanah' => $request->kode_jenis_tanah,
            'nama_jenis_tanah'=> $request->nama_jenis_tanah, 
            'geojson_file'=> $upload,
            'style'=> $request->style,
            'status'=> $request->status,
        ];
        if(JenisTanah::insert($data)){
            return redirect()->route('jenis_tanah.index')->with('success','Input Data Berhasil');
        }
        return redirect()->route('jenis_tanah.index')->with('error','Oops,Ada kesalahan teknis. silahkan coba lagi !');
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
        $data = JenisTanah::findOrFail($id);
        return view('base_layer.jenis_tanah.form',compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $oldData = JenisTanah::findOrFail($id);
        $validate = \Validator::make($request->all(),[
            'kode_jenis_tanah' => ['required'],
            'nama_jenis_tanah' => ['required'],
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
            'kode_jenis_tanah' => $request->kode_jenis_tanah,
            'nama_jenis_tanah'=> $request->nama_jenis_tanah, 
            'geojson_file'=> $upload,
            'style'=> $request->style,
            'status'=> $request->status,
        ];
        if($oldData->update($data)){
            return redirect()->route('jenis_tanah.index')->with('success','Update Data Berhasil');
        }
        return redirect()->route('jenis_tanah.index')->with('error','Oops,Ada kesalahan teknis. silahkan coba lagi !');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = JenisTanah::findOrFail($id);
        if(file_exists('uploads/geojson/'.$data->geojson_file)){
            unlink('uploads/geojson/'.$data->geojson_file);
        }
        $data->delete();
        return redirect()->route('jenis_tanah.index')->with('success','Hapus Data Berhasil');
   
    }
}
