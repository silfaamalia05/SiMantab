@extends('layouts.app')
@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4 dark:text-white">{{ isset($data) ? 'Edit' : 'Tambah' }}Data Kategori Logistik</h2>
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4">
            <div class="flex justify-between text-center items-center dark:text-white my-2">
                <h6>{{ isset($data) ? 'Edit' : 'Tambah' }} Data Kategori Logistik</h6>
                <a href="{{ route('kategori_logistik.index') }}" class="bg-blue-900 text-white px-6 py-2 no-underline"><i
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
            <form action="{{ isset($data) ? route('kategori_logistik.update', $data->id) : route('kategori_logistik.store') }}"
                method="POST" enctype="multipart/form-data">
                @method(isset($data) ? 'PUT' : 'POST')
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">Nama Kategori</label>
                    <input type="text" name="name" id="name" required placeholder="Kategori"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ isset($data) ? $data->name : old('v') }}"
                        {{ !isset($data) ? 'required' : '' }}>
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

