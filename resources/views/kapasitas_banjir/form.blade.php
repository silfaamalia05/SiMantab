@extends('layouts.app')
@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4 dark:text-white">Set Kapasitas Banjir</h2>
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4">
            <div class="flex justify-between text-center items-center dark:text-white my-2">
                <h6>Set Kapasitas Banjir</h6>
                <a href="{{ route('kapasitas_banjir') }}" class="bg-blue-900 text-white px-6 py-2 no-underline"><i
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
            <form action="{{ route('kapasitas_banjir.set') }}" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <input type="hidden" name="batas_wilayah_kec_desa_id" id="batas_wilayah_kec_desa_id" value="{{$id}}">
                <div>
                    <label for="index_ketahanan_daerah"
                        class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">Index Ketahanan Daerah</label>
                    <input type="text" name="index_ketahanan_daerah" id="index_ketahanan_daerah" required
                        placeholder="Index Ketahanan Daerah"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ isset($data->KapasitasBanjir->index_ketahanan_daerah) ? $data->KapasitasBanjir->index_ketahanan_daerah : '0' }}"
                        {{ !isset($data) ? 'required' : '' }}>
                </div>
                <div>
                    <label for="index_kesiapsiagaan"
                        class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">Index Kesiapsiagaan</label>
                    <input type="text" name="index_kesiapsiagaan" id="index_kesiapsiagaan" required
                        placeholder="Index Kesiapsiagaan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ isset($data->KapasitasBanjir->index_kesiapsiagaan) ? $data->KapasitasBanjir->index_kesiapsiagaan : '0' }}"
                        {{ !isset($data) ? 'required' : '' }}>
                </div>
                <div>
                    <label for="index_kapasitas"
                        class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">Index Kapasitas</label>
                    <input type="text" name="index_kapasitas" id="index_kapasitas" required
                        placeholder="Index Kapasitas"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ isset($data->KapasitasBanjir->index_kapasitas) ? $data->KapasitasBanjir->index_kapasitas : '0' }}"
                        {{ !isset($data) ? 'required' : '' }}>
                </div>
                <div class="flex justify-between mt-2">
                    <button type="submit" class="bg-blue-900 text-white px-6 py-2 no-underline rounded-lg"><i class="fas fa-save"></i> Simpan</button>
                    <button type="reset" class="p-2 bg-red-500 text-sm text-white rounded-lg"><i class="fas fa-ban"></i> Reset</button>
                </div>
            </form>
        </div>
    </div>
@endsection
