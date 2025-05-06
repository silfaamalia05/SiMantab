@extends('layouts.app')
@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4 dark:text-white">Data Potensi Penduduk Terpapar</h2>
        <div class="bg-white shadow-md rounded-lg p-4">
            <div class="flex justify-between text-center items-center my-2">
                <h6>Data Potensi Penduduk Terpapar</h6>

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
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b text-left">No</th>
                        <th class="py-2 px-4 border-b text-left">Kab / Kota</th>
                        <th class="py-2 px-4 border-b text-left">Kecamatan / Desa</th>
                        <th class="py-2 px-4 border-b text-left">Penduduk Terpapar</th>
                        <th class="py-2 px-4 border-b text-left">Kelompok Umur Rentan</th>
                        <th class="py-2 px-4 border-b text-left">Penduduk Disabilitas</th>
                        <th class="py-2 px-4 border-b text-left">Penduduk Miskin</th>
                        <th class="py-2 px-4 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td class="py-2 px-4 text-left">{{ $loop->index + 1 }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $item->BatasWilayahKabKota->WADMKK }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $item->WADMKC }}</td>
                            <td class="py-2 px-4 border-b text-left">
                                {{ $item->PotensiPendudukTerpapar->penduduk_terpapar ?? '0' }}</td>
                            <td class="py-2 px-4 border-b text-left">
                                {{ $item->PotensiPendudukTerpapar->kelompok_umur_rentan ?? '0' }}</td>
                            <td class="py-2 px-4 border-b text-left">
                                {{ $item->PotensiPendudukTerpapar->penduduk_disabilitas ?? '0' }}</td>
                            <td class="py-2 px-4 border-b text-left">
                                {{ $item->PotensiPendudukTerpapar->penduduk_miskin ?? '0' }}</td>
                            <td class="py-2 px-4 border-b text-center"> <a
                                    href="{{ route('potensi_penduduk_terpapar.form', $item->id) }}"
                                    class="p-2 bg-yellow-500 text-sm rounded-lg">Edit</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center">Data Tidak Tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
