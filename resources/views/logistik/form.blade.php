@extends('layouts.app')
@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4 dark:text-white">{{ isset($data) ? 'Edit' : 'Tambah' }}Data Logistik</h2>
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4">
            <div class="flex justify-between text-center items-center dark:text-white my-2">
                <h6>{{ isset($data) ? 'Edit' : 'Tambah' }} Data Logistik</h6>
                <a href="{{ route('logistik.index') }}" class="bg-blue-900 text-white px-6 py-2 no-underline"><i
                        class="fas fa-table"></i></a>
            </div>
            @if (session()->has('success'))
                <div class="w-full text-center text-white bg-green-400 py-2 my-2 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="w-full text-center text-white bg-red-400 py-2 my-2 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ isset($data) ? route('logistik.update', $data->id) : route('logistik.store') }}"
                method="POST" enctype="multipart/form-data">
                @method(isset($data) ? 'PUT' : 'POST')
                @csrf
                <div>
                    <label for="jenis_alat" class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">Jenis alat</label>
                    <input type="text" name="jenis_alat" id="jenis_alat" required placeholder="Jenis Alat"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ isset($data) ? $data->jenis_alat : old('jenis_alat') }}"
                        {{ !isset($data) ? 'required' : '' }}>
                </div>
                <div>
                    <label for="kategori_logistik"
                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Kategori Logistik</label>
                    {{-- <input type="text" name="kebutuhan" id="kebutuhan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> --}}

                    <select name="kategori_logistik_id" id="kategori_logistik_id" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $item)
                           <option value="{{$item->id}}" {{ isset($data) && $data->kategori_logistik_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                       @endforeach
                    </select>
                </div>
                <div>
                    <label for="merk" class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">Merk</label>
                    <input type="text" name="merk" id="merk" required placeholder="Merk"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ isset($data) ? $data->merk : old('merk') }}"
                        {{ !isset($data) ? 'required' : '' }}>
                </div>
                <div>
                    <label for="model" class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">Model</label>
                    <input type="text" name="model" id="model" required placeholder="Model"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ isset($data) ? $data->model : old('model') }}"
                        {{ !isset($data) ? 'required' : '' }}>
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">Type</label>
                    <input type="text" name="type" id="type" required placeholder="Type"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ isset($data) ? $data->type : old('type') }}"
                        {{ !isset($data) ? 'required' : '' }}>
                </div>
                <div>
                    <label for="kapasitas" class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">Kapasitas</label>
                    <input type="text" name="kapasitas" id="kapasitas" required placeholder="Kapasitas"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ isset($data) ? $data->kapasitas : old('kapasitas') }}"
                        {{ !isset($data) ? 'required' : '' }}>
                </div>
                <div>
                    <label for="jumlah" class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" required placeholder="Jumlah"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ isset($data) ? $data->jumlah : old('jumlah') }}"
                        {{ !isset($data) ? 'required' : '' }}>
                </div>
                <div>
                    <label for="kondisi_baik" class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1"> Kondisi Baik</label>
                    <input type="number" name="kondisi_baik" id="kondisi_baik" required placeholder="Jumlah Kondisi Baik"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ isset($data) ? $data->kondisi_baik : old('kondisi_baik') }}"
                        {{ !isset($data) ? 'required' : '' }}>
                </div>
                <div>
                    <label for="kondisi_rusak_ringan" class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1"> Kondisi rusak ringan</label>
                    <input type="number" name="kondisi_rusak_ringan" id="kondisi_rusak_ringan" required placeholder="Jumlah Kondisi Rusak Ringan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ isset($data) ? $data->kondisi_rusak_ringan : old('kondisi_rusak_ringan') }}"
                        {{ !isset($data) ? 'required' : '' }}>
                </div>
                <div>
                    <label for="kondisi_rusak_berat" class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">Kondisi Rusak Berat</label>
                    <input type="number" name="kondisi_rusak_berat" id="kondisi_rusak_berat" required placeholder="Jumlah Kondisi Rusak Berat"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ isset($data) ? $data->kondisi_rusak_berat : old('kondisi_rusak_berat') }}"
                        {{ !isset($data) ? 'required' : '' }}>
                </div>
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" required placeholder="Lokasi"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ isset($data) ? $data->lokasi : old('lokasi') }}"
                        {{ !isset($data) ? 'required' : '' }}>
                </div>
               
                <div>
                    <label for="keterangan" class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">Keterangan</label>
                    <textarea cols="5" rows="10"  name="keterangan" id="keterangan" placeholder="Keterangan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        {{ !isset($data) ? 'required' : '' }}>{{ isset($data) ? $data->keterangan : old('keterangan') }}</textarea>
                </div>
              
                <div class="flex justify-between mt-2">
                    <button type="submit" class="bg-blue-900 text-white px-6 py-2 no-underline rounded-lg"><i
                            class="fas fa-save"></i> Simpan</button>
                    <button type="reset" class="p-2 bg-red-500 text-sm text-white rounded-lg"><i class="fas fa-ban"></i>
                        Reset</button>
                </div>
            </form>
        </div>
    </div>
@endsection

