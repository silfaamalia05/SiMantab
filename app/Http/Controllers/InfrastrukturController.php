<?php

namespace App\Http\Controllers;

use App\Models\Infrastruktur;
use Illuminate\Http\Request;

class InfrastrukturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Infrastruktur::latest()->get();
        return view('infrastruktur.index',compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('infrastruktur.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = \Validator::make($request->all(),[
            'kode_infrastruktur' => ['required'],
            'nama_infrastruktur' => ['required'],
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
        $upload_icon = $this->UploadFile($request,'style','uploads');
        $upload = $this->UploadFile($request,'geojson_file','uploads/geojson');
        $data = [
            'kode_infrastruktur' => $request->kode_infrastruktur,
            'nama_infrastruktur'=> $request->nama_infrastruktur,
            'properties_show'=> $request->properties_show,
            'geojson_file'=> $upload,
            'style'=> $upload_icon != null ? $upload_icon : '-',
            'status'=> $request->status,
        ];
        if(Infrastruktur::insert($data)){
            return redirect()->route('infrastruktur.index')->with('success','Input Data Berhasil');
        }
        return redirect()->route('infrastruktur.index')->with('error','Oops,Ada kesalahan teknis. silahkan coba lagi !');
    
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
        $data = Infrastruktur::findOrFail($id);
        return view('infrastruktur.form',compact(['data']));
   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $oldData = Infrastruktur::findOrFail($id);
        $validate = \Validator::make($request->all(),[
            'kode_infrastruktur' => ['required'],
            'nama_infrastruktur' => ['required'],
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
        $upload_icon = $oldData->style;
        if($request->hasFile('style')){
            $upload_icon = $this->UploadFile($request,'style','uploads');
            if(file_exists('uploads/'.$oldData->style)){
                unlink('uploads/'.$oldData->style);
            }
        }
      
        $data = [
            'kode_infrastruktur' => $request->kode_infrastruktur,
            'nama_infrastruktur'=> $request->nama_infrastruktur,
            'properties_show'=> $request->properties_show,
            'geojson_file'=> $upload,
            'style'=> $upload_icon,
            'status'=> $request->status,
        ];
        if($oldData->update($data)){
            return redirect()->route('infrastruktur.index')->with('success','Update Data Berhasil');
        }
        return redirect()->route('infrastruktur.index')->with('error','Oops,Ada kesalahan teknis. silahkan coba lagi !');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $oldData = Infrastruktur::findOrFail($id);
        if(file_exists('uploads/geojson/'.$oldData->geojson_file)){
            unlink('uploads/geojson/'.$oldData->geojson_file);
        }
        if(file_exists('uploads/'.$oldData->style)){
            unlink('uploads/'.$oldData->style);
        }
        $oldData->delete();
        return redirect()->route('infrastruktur.index')->with('success','Hapus Data Berhasil');
    }
}
