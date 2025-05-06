@extends('layouts.app')
@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4 dark:text-white">Data Logistik</h2>
        <div class="bg-white dark:bg-gray-800 dark:text-white shadow-md rounded-lg p-4">
            <div class="flex justify-between text-center items-center my-2">
                <h6>Data Logistik</h6>
                <div class="flex text-center item-center my-2">
                    <a href="{{route('logistik.print_pdf')}}" class="bg-green-500 text-white px-6 py-2 no-underline"><i
                        class="fas fa-print"></i></a>
                    <a href="{{ route('logistik.create') }}"  class="bg-blue-900 text-white px-6 py-2 no-underline"><i
                            class="fas fa-plus"></i></a>
                </div>

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
                        <th class="py-2 px-4 border-b text-left" rowspan="2">No</th>
                        <th class="py-2 px-4 border-b text-left" rowspan="2">Jenis Alat</th>
                        <th class="py-2 px-4 border-b text-left" rowspan="2">Merk/Model/Type</th>
                        <th class="py-2 px-4 border-b text-left" rowspan="2">Kapasitas</th>
                        <th class="py-2 px-4 border-b text-left" rowspan="2">Jumlah</th>
                        <th class="py-2 px-4 border-b text-center" colspan="3">Kondisi</th>
                        <th class="py-2 px-4 border-b text-left" rowspan="2">Lokasi</th>
                        <th class="py-2 px-4 border-b text-left" rowspan="2">Keterangan</th>
                        <th class="py-2 px-4 border-b text-center" rowspan="2">Actions</th>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 border-b text-center">Baik</th>
                        <th class="py-2 px-4 border-b text-center">Rusak Ringan</th>
                        <th class="py-2 px-4 border-b text-center">Rusak Berat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr class="border-b">
                            <td class="py-2 px-4 text-left">{{ $loop->index + 1 }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $item->jenis_alat }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $item->merk }} / {{ $item->model }} /
                                {{ $item->type }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $item->kapasitas }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $item->jumlah }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $item->kondisi_baik }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $item->kondisi_rusak_ringan }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $item->kondisi_rusak_berat }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $item->lokasi }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $item->keterangan }}</td>
                            <td class="py-2 px-4 text-center">
                                <form action="{{ route('logistik.destroy', $item->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ route('logistik.edit', $item->id) }}"
                                        class="p-2 bg-yellow-500 text-sm rounded-lg">Edit</a>
                                    <button type="submit"
                                        class="p-2 bg-red-500 text-sm rounded-lg text-white">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center p-2">Data Tidak Tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
