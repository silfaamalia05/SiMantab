@extends('layouts.app')
@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4 dark:text-white">{{ isset($data) ? 'Edit' : 'Tambah' }} Data Kelerengan</h2>
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4">
            <div class="flex justify-between text-center items-center dark:text-white my-2">
                <h6>{{ isset($data) ? 'Edit' : 'Tambah' }} Data Kelerengan</h6>
                <a href="{{ route('kelerengan.index') }}" class="bg-blue-900 text-white px-6 py-2 no-underline"><i
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
            <form action="{{ isset($data) ? route('kelerengan.update', $data->id) : route('kelerengan.store') }}" method="POST" enctype="multipart/form-data">
                @method(isset($data) ? 'PUT' : 'POST')
                @csrf
                <div>
                    <label for="kode_kelerengan"
                        class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">Kode Kelerengan</label>
                    <input type="text" name="kode_kelerengan" id="kode_kelerengan" required
                        placeholder="Kode Kelerengan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ isset($data) ? $data->kode_kelerengan : old('kode_kelerengan') }}"
                        {{ !isset($data) ? 'required' : '' }}>
                </div>
                <div>
                    <label for="nama_kelerengan"
                        class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">Nama Kelerengan</label>
                    <input type="text" name="nama_kelerengan" id="nama_kelerengan" required
                        placeholder="Nama Kelerengan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ isset($data) ? $data->nama_kelerengan : old('nama_kelerengan') }}"
                        {{ !isset($data) ? 'required' : '' }}>
                </div>
                <div>
                    <label for="geojson_file" class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">File
                        (dengan format .Json)</label>
                    @isset($data)
                        <a href="{{ asset('uploads/geojson/' . $data->geojson_file) }}"
                            class="text-blue-500 m-2">{{ $data->geojson_file }}</a>
                    @endisset
                    <input type="file" name="geojson_file" id="geojson_file" {{!isset($data) ? 'required' : ''}}
                        placeholder="File Infrastruktur"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div>
                    <label for="style"
                        class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">Warna</label>
                    <input type="color" name="style" id="style" required
                        placeholder="Warna"
                        class=""
                        value="{{ isset($data) ? $data->style : old('style') }}"
                        {{ !isset($data) ? 'required' : '' }}>
                </div>
                
                <div>
                    <label for="status"
                        class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">Status</label>
                    <select name="status" id="status"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="1" {{ isset($data) && $data->status == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ isset($data) && $data->status == '0' ? 'selected' : '' }}>Tidak Aktif
                        </option>
                    </select>
                </div>
                <div class="flex justify-between mt-2">
                    <button type="submit" class="bg-blue-900 text-white px-6 py-2 no-underline rounded-lg"><i class="fas fa-save"></i> Simpan</button>
                    <button type="reset" class="p-2 bg-red-500 text-sm text-white rounded-lg"><i class="fas fa-ban"></i> Reset</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('content-js')
    <script>
        $('#style').change(function(event) {
            $("#view_img").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));
        });
    </script>
@endsection