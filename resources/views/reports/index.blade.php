@extends('layouts.app')
@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4 dark:text-white">Data Laporan</h2>
        <div class="bg-white dark:bg-gray-800 dark:text-white shadow-md rounded-lg p-4">
            <div class="flex justify-between text-center items-center my-2">
                <h6>Data Laporan </h6>
                <a href="{{ route('reports.create') }}" class="bg-blue-900 text-white px-6 py-2 no-underline"><i
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
                        <th class="py-2 px-4 border-b text-left">Bencana Banjir</th>
                        <th class="py-2 px-4 border-b text-left">Lokasi</th>
                        <th class="py-2 px-4 border-b text-left">Status</th>
                        <th class="py-2 px-4 border-b text-left">Tanggal Mulai</th>
                        <th class="py-2 px-4 border-b text-left">Estimasi Selesai</th>
                        <th class="py-2 px-4 border-b text-left">Keterangan</th>

                        <th class="py-2 px-4 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr class="border-b">
                            <td class="py-2 px-4 text-left">{{ $loop->index + 1 }}</td>
                            <th class="py-2 px-4 border-b text-left">{{ $item->jenis_bencana }}</th>

                            <td class="py-2 px-4 text-left">
                                {{ $item->lokasi }}
                            </td>
                            <td class="py-2 px-4 text-left">
                                @switch($item->status_laporan)
                                    @case(0)
                                    <span class="bg-red-500 text-white px-2 py-1 rounded-full text-sm">Belum ditangani</span>
                                        @break
                                    @case(1)
                                    <span class="bg-yellow-500 text-white px-2 py-1 rounded-full text-sm">Dalam Penanganan</span>
                                        @break
                                    @case(2)
                                    <span class="bg-green-500 text-white px-2 py-1 rounded-full text-sm">Sudah Ditangani</span>
                                        @break
                                    @default
                                        
                                @endswitch
                            </td>
                            <td class="py-2 px-4 border-b text-left">
                                {{ date_format(date_create($item->waktu_kejadian), 'D, d M Y H:i:s') }}</td>

                            <td class="py-2 px-4 border-b text-left">
                                {{ $item->estimasi_selesai != '' ? date_format(date_create($item->estimasi_selesai), 'D, d M Y H:i:s') : '-' }}
                            </td>
                            <td class="py-2 px-4 border-b text-left">
                                {{ $item->keterangan_laporan != null ? $item->keterangan_laporan : '-' }}
                            </td>
                            <td class="py-2 px-4 text-center">
                                <form action="{{ route('reports.destroy', $item->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    @if (auth()->user()->role == 'ADMIN')
                                    <a href="{{ route('reports.edit', $item->id) }}"
                                        class="p-2 bg-yellow-500 text-sm rounded-lg">Edit</a>    
                                        <button type="submit"
                                        class="p-2 bg-red-500 text-sm rounded-lg text-white">Hapus</button>
                                    @else
                                        <span class="p-2 bg-red-500 text-white rounded-full">No Actions</span>

                                    @endif
                                    
                                    
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
