@extends('layouts.app')
@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4 dark:text-white">Data Kategori Logistik</h2>
        <div class="bg-white dark:bg-gray-800 dark:text-white shadow-md rounded-lg p-4">
            <div class="flex justify-between text-center items-center my-2">
                <h6>Data Kategori Logistik</h6>
                <a href="{{ route('kategori_logistik.create') }}" class="bg-blue-900 text-white px-6 py-2 no-underline"><i
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
                    
                    <tr>
                        <th class="py-2 px-4 border-b">No</th>
                        <th class="py-2 px-4 border-b">Kategori</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr class="border-b">
                            <td class="py-2 px-4 text-center">{{ $loop->index + 1 }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $item->name }}</td>
                         
                            <td class="py-2 px-4 text-center">
                                <form action="{{ route('kategori_logistik.destroy', $item->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ route('kategori_logistik.edit', $item->id) }}"
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
