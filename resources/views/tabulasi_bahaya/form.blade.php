@extends('layouts.app')
@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4 dark:text-white">Set Tabulasi Bahaya Banjir</h2>
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4">
            <div class="flex justify-between text-center items-center dark:text-white my-2">
                <h6>Set Tabulasi Bahaya Banjir</h6>
                <a href="{{ route('tabulasi_bahaya') }}" class="bg-blue-900 text-white px-6 py-2 no-underline"><i
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
            <form action="{{ route('tabulasi_bahaya.set') }}" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <input type="hidden" name="batas_wilayah_kec_desa_id" id="batas_wilayah_kec_desa_id"
                    value="{{ $id }}">
                <div>
                    <label for="lb_rendah" class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">Lebar
                        Bahaya (Rendah)</label>
                    <input type="text" name="lb_rendah" id="lb_rendah" required placeholder="Lebar Bahaya (Rendah)"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ isset($data->TabulasiBahayaBanjir->lb_rendah) ? $data->TabulasiBahayaBanjir->lb_rendah : '0' }}"
                        {{ !isset($data) ? 'required' : '' }}>
                </div>
                <div>
                    <label for="lb_sedang" class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">Lebar
                        Bahaya (Sedang)</label>
                    <input type="text" name="lb_sedang" id="lb_sedang" required placeholder="Lebar Bahaya (Sedang)"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ isset($data->TabulasiBahayaBanjir->lb_sedang) ? $data->TabulasiBahayaBanjir->lb_sedang : '0' }}"
                        {{ !isset($data) ? 'required' : '' }}>
                </div>
                <div>
                    <label for="lb_tinggi" class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">Lebar
                        Bahaya (Tinggi)</label>
                    <input type="text" name="lb_tinggi" id="lb_tinggi" required placeholder="Lebar Bahaya (Tinggi)"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ isset($data->TabulasiBahayaBanjir->lb_tinggi) ? $data->TabulasiBahayaBanjir->lb_tinggi : '0' }}"
                        {{ !isset($data) ? 'required' : '' }}>
                </div>
                <div>
                    <label for="kelas"
                        class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">Kelas</label>
                    <select name="kelas" id="kelas"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="Rendah"
                            {{ isset($data->TabulasiBahayaBanjir->kelas) && $data->TabulasiBahayaBanjir->kelas == 'Rendah' ? 'selected' : '' }}>
                            Rendah</option>
                        <option value="Sedang"
                            {{ isset($data->TabulasiBahayaBanjir->kelas) && $data->TabulasiBahayaBanjir->kelas == 'Sedang' ? 'selected' : '' }}>
                            Sedang</option>
                        <option value="Tinggi"
                            {{ isset($data->TabulasiBahayaBanjir->kelas) && $data->TabulasiBahayaBanjir->kelas == 'Tinggi' ? 'selected' : '' }}>
                            Tinggi</option>
                        </option>
                    </select>
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
