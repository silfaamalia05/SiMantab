<?php

namespace App\Http\Controllers;

use App\Models\KategoriLogistik;
use Illuminate\Http\Request;
use Validator;

class KategoriLogistikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = KategoriLogistik::latest()->get();
        return view('kategori_logistik.index',compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('kategori_logistik.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = Validator::make($request->all(),[
            'name' => ['required']
        ]);
        if($validate->fails()){
            return redirect()->back()->with('error',$validate->errors()->messages())->withInput();
        }
        $insert = KategoriLogistik::insert([
            'name' => $request->name,
           
        ]);
        if($insert){
            return redirect()->route('kategori_logistik.index')->with('success','Input data berhasil !');
        }
        return redirect()->route(route: 'kategori_logistik.index')->with('error','Oops,Ada kesalahan teknis. silahkan coba lagi !');
    
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
        $data = KategoriLogistik::findOrFail($id);
        return view('kategori_logistik.form',compact(['data']));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $oldData = KategoriLogistik::findOrFail($id);
        $validate = Validator::make($request->all(),[
            'name' => ['required']
        ]);
        if($validate->fails()){
            return redirect()->back()->with('error',$validate->errors()->messages())->withInput();
        }
        $update = $oldData->update([
            'name' => $request->name,
           
        ]);
        if($update){
            return redirect()->route('kategori_logistik.index')->with('success','Update data berhasil !');
        }
        return redirect()->route(route: 'kategori_logistik.index')->with('error','Oops,Ada kesalahan teknis. silahkan coba lagi !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $oldData = KategoriLogistik::findOrFail($id);
        $oldData->delete();
        return redirect()->route('kategori_logistik.index')->with('success','Hapus data berhasil !');
    }
}
