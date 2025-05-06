@extends('layouts.app')
@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4 dark:text-white">Data Batas Desa / Kecamatan</h2>
        <div class="bg-white dark:bg-gray-800 dark:text-white shadow-md rounded-lg p-4">
            <div class="flex justify-between text-center items-center my-2">
                <h6>Data Batas Desa / Kecamatan</h6>
                <a href="{{ route('batas_kec_desa.create') }}" class="bg-blue-900 text-white px-6 py-2 no-underline"><i
                        class="fas fa-plus"></i></a>
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
            <table class="min-w-full bg-white dark:bg-gray-900 border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-900">
                        <th class="py-2 px-4 border-b text-left">No</th>
                        <th class="py-2 px-4 border-b text-left">Kode</th>
                        <th class="py-2 px-4 border-b text-left">Nama Kec / Desa</th>
                        <th class="py-2 px-4 border-b text-left">File Geojson</th>
                        <th class="py-2 px-4 border-b text-left">Warna</th>
                        <th class="py-2 px-4 border-b text-left">Status</th>
                        <th class="py-2 px-4 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr class="border-b">
                            <td class="py-2 px-4 text-left">{{ $loop->index + 1 }}</td>
                            <td class="py-2 px-4 text-left">{{ $item->KDCPUM }}</td>
                            <td class="py-2 px-4 text-left">{{ $item->WADMKC }}</td>
                            <td class="py-2 px-4 text-left">
                                <a href="{{ asset('uploads/geojson/' . $item->geojson_file) }}">{{ $item->geojson_file }}</a>
                            </td>
                            <td class="py-2 px-4 text-left"><button class="p-5"
                                    style="background-color:{{ $item->style }};"></button></td>
                            <td class="py-2 px-4 text-left">{!! $item->status == '0'
                                ? '<span class="bg-red-500 text-white px-2 py-1 rounded-full text-sm">Tidak Aktif</span>'
                                : '<span class="bg-green-500 text-white py-1 px-2 rounded-full ">Aktif</span>' !!}</td>
                            <td class="py-2 px-4 text-center">
                                <form action="{{ route('batas_kec_desa.destroy', $item->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ route('batas_kec_desa.edit', $item->id) }}"
                                        class="p-2 bg-yellow-500 text-sm rounded-lg">Edit</a>
                                    <button type="submit"
                                        class="p-2 bg-red-500 text-sm rounded-lg text-white">Hapus</button>
                                </form>
                            </td>
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
