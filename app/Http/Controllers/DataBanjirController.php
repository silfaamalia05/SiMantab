<?php

namespace App\Http\Controllers;

use App\Models\DataBanjir;
use Illuminate\Http\Request;

class DataBanjirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = DataBanjir::latest()->get();
        return view('data_banjir.index',compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('data_banjir.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = \Validator::make($request->all(),[
            'kode_data' => ['required'],
            'nama_data' => ['required'],
            'geojson_file' => ['required'],
            'properties_show' => ['required'],
        ]);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $ext = $request->file('geojson_file')->getClientOriginalExtension();
        if($ext != 'geojson'){
            return redirect()->back()->with('error','File harus berekstensi Geojson (.geojson)')->withInput();
        }
        $upload = $this->UploadFile($request,'geojson_file','uploads/geojson');
        $data = [
            'kode_data' => $request->kode_data,
            'nama_data'=> $request->nama_data,
            'properties_show'=> $request->properties_show,
            'geojson_file'=> $upload,
          
            'status'=> $request->status,
        ];
        if(DataBanjir::insert($data)){
            return redirect()->route('data_banjir.index')->with('success','Input Data Berhasil');
        }
        return redirect()->route('data_banjir.index')->with('error','Oops,Ada kesalahan teknis. silahkan coba lagi !');
    
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
        $data = DataBanjir::findOrFail($id);
        return view('data_banjir.form',compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $oldData = DataBanjir::findOrFail($id);
        $validate = \Validator::make($request->all(),[
            'kode_data' => ['required'],
            'nama_data' => ['required'],
            'properties_show' => ['required'],
        ]);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $upload = $oldData->geojson_file;
        if($request->hasFile('geojson_file')){
            $ext = $request->file('geojson_file')->getClientOriginalExtension();
            if($ext != 'geojson'){
                return redirect()->back()->with('error','File harus berekstensi Geojson (.geojson)')->withInput();
            }
            $upload = $this->UploadFile($request,'geojson_file','uploads/geojson');
            if(file_exists('uploads/geojson/'.$oldData->geojson_file)){
                unlink('uploads/geojson/'.$oldData->geojson_file);
            }
        }
      
        $data = [
            'kode_data' => $request->kode_data,
            'nama_data'=> $request->nama_data,
            'properties_show'=> $request->properties_show,
            'geojson_file'=> $upload,
          
            'status'=> $request->status,
        ];
        if($oldData->update($data)){
            return redirect()->route('data_banjir.index')->with('success','Update Data Berhasil');
        }
        return redirect()->route('data_banjir.index')->with('error','Oops,Ada kesalahan teknis. silahkan coba lagi !');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $oldData = DataBanjir::findOrFail($id);
        if(file_exists('uploads/geojson/'.$oldData->geojson_file)){
            unlink('uploads/geojson/'.$oldData->geojson_file);
        }
        $oldData->delete();
        return redirect()->route('data_banjir.index')->with('success','Hapus Data Berhasil');
    
    }
}
