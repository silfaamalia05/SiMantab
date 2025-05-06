@extends('layouts.app')

@section('content')
    <section class="mt-2 bg-gray-50 h-dvh dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
            <div class="w-full bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Form {{ isset($data) ? 'Edit' : '' }} Pelaporan Bencana
                    </h1>

                    @if (session('success'))
                        <div
                            class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ isset($data) ? route('reports.update', $data->id) : route('reports.store') }}"
                        method="POST" class="space-y-4" enctype="multipart/form-data">
                        @method(isset($data) ? 'PUT' : 'POST')
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <div id="map" class="mt-4" style="height: 500px; border: 1px solid #ccc;"></div>
                            </div>
                            <div style="max-height: 500px; overflow-y: scroll; padding:10px">
                                <h1 class="font-bold">1. Bencana</h1>
                                <div>
                                    <label for="jenis_bencana"
                                        class="block text-sm font-medium text-gray-900 dark:text-white mt-2 mb-1">Jenis
                                        Bencana</label>
                                    <input type="text"
                                        value="{{ isset($data) ? $data->jenis_bencana : old('jenis_bencana') }}"
                                        name="jenis_bencana" id="jenis_bencana" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>

                                <div>
                                    <label for="waktu_kejadian"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Waktu
                                        Kejadian</label>
                                    <input type="datetime-local"
                                        value="{{ isset($data) ? $data->waktu_kejadian : old('waktu_kejadian') }}"
                                        name="waktu_kejadian" id="waktu_kejadian" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>

                                <div>
                                    <label for="lokasi"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Lokasi</label>
                                    <input type="text" value="{{ isset($data) ? $data->lokasi : old('lokasi') }}"
                                        name="lokasi" id="lokasi" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>

                                <div>
                                    <label for="koordinat"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Koordinat</label>
                                    <input type="text" value="{{ isset($data) ? $data->koordinat : old('koordinat') }}"
                                        name="koordinat" id="koordinat" required placeholder="-3.4453, 114.8450"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <div id="note-koordinat">

                                    </div>
                                </div>

                                <div>
                                    <label for="sungai"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Sungai
                                        (Opsional)</label>
                                    <input type="text" value="{{ isset($data) ? $data->sungai : old('sungai') }}"
                                        name="sungai" id="sungai"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>

                                <br>
                                <h1 class="font-bold">2. Korban</h1>
                                <div class="mt-2 grid grid-cols-2 gap-2">
                                    <div>
                                        <label for="meninggal"
                                            class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">Meninggal</label>
                                        <input type="number"
                                            value="{{ isset($data) ? $data->meninggal : old('meninggal') }}"
                                            name="meninggal" id="meninggal" value="0"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="luka_berat"
                                            class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">Luka
                                            Berat</label>
                                        <input type="number"
                                            value="{{ isset($data) ? $data->luka_berat : old('luka_berat') }}"
                                            name="luka_berat" id="luka_berat" value="0"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="luka-ringan"
                                            class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">Luka
                                            Ringan</label>
                                        <input type="number"
                                            value="{{ isset($data) ? $data->luka_ringan : old('luka_ringan') }}"
                                            name="luka-ringan" id="luka-ringan" value="0"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="hilang"
                                            class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">Hilang/Hanyut</label>
                                        <input type="number" value="{{ isset($data) ? $data->hilang : old('hilang') }}"
                                            name="hilang" id="hilang" value="0"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="mengungsi"
                                            class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">Mengungsi</label>
                                        <input type="number"
                                            value="{{ isset($data) ? $data->mengungsi : old('mengungsi') }}"
                                            name="mengungsi" id="mengungsi" value="0"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                </div>

                                <br>
                                <h1 class="font-bold">3. Kerusakan</h1>
                                <div class="mt-2 grid grid-cols-2 gap-2">
                                    <div>
                                        <label for="rumah"
                                            class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">Rumah</label>
                                        <input type="number" value="{{ isset($data) ? $data->rumah : old('rumah') }}"
                                            name="rumah" id="rumah"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="kantor"
                                            class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">Kantor</label>
                                        <input type="number" value="{{ isset($data) ? $data->kantor : old('kantor') }}"
                                            name="kantor" id="kantor"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="fasum-faskes"
                                            class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">Fasum/Faskes</label>
                                        <input type="number"
                                            value="{{ isset($data) ? $data['fasum-faskes'] : old('fasum-faskes') }}"
                                            name="fasum-faskes" id="fasum-faskes"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="jalan-jembatan"
                                            class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">Jalan/Jembatan</label>
                                        <input type="number"
                                            value="{{ isset($data) ? $data['jalan-jembatan'] : old('jalan-jembatan') }}"
                                            name="jalan-jembatan" id="jalan-jembatan"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="sawah-lahan-pertanian"
                                            class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">Sawah/Lahan
                                            Pertanian</label>
                                        <input type="number"
                                            value="{{ isset($data) ? $data['sawah-lahan-pertanian'] : old('sawah-lahan-pertanian') }}"
                                            name="sawah-lahan-pertanian" id="sawah-lahan-pertanian"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                </div>

                                <br>
                                <h1 class="font-bold">4. Bahaya</h1>
                                <div>
                                    <label for="pemukiman"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Pemukiman</label>
                                    {{-- <input type="text" name="pemukiman" id="pemukiman"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> --}}

                                    <select name="pemukiman" id="pemukiman" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="Tidak Terdampak"
                                            {{ isset($data) && $data->pemukiman == 'Tidak Terdampak' ? 'selected' : '' }}>
                                            Tidak Terdampak</option>
                                        <option value="Terdampak Ringan (Genangan < 30cm, tidak masuk rumah)"
                                            {{ isset($data) && $data->pemukiman == 'Terdampak Ringan (Genangan < 30cm, tidak masuk rumah)' ? 'selected' : '' }}>
                                            Terdampak
                                            Ringan (Genangan < 30cm, tidak masuk rumah)</option>
                                        <option value="Terdampak Sedang (Genangan 30 - 70 cm, masuk rumah bagian bawah)"
                                            {{ isset($data) && $data->pemukiman == 'Terdampak Sedang (Genangan 30 - 70 cm, masuk rumah bagian bawah)' ? 'selected' : '' }}>
                                            Terdampak Sedang (Genangan 30 - 70 cm, masuk rumah bagian bawah)</option>
                                        <option value="Terdampak Berat (Genangan > 70 cm, merendam seluruh rumah)"
                                            {{ isset($data) && $data->pemukiman == 'Terdampak Berat (Genangan > 70 cm, merendam seluruh rumah)' ? 'selected' : '' }}>
                                            Terdampak Berat (Genangan > 70 cm, merendam seluruh rumah)</option>
                                        <option value="Rusak Berat dan tidak layak huni"
                                            {{ isset($data) && $data->pemukiman == 'Rusak Berat dan tidak layak huni' ? 'selected' : '' }}>
                                            Rusak Berat dan tidak layak huni
                                        </option>
                                        <option value="Lainnya"
                                            {{ isset($data) && $data->pemukiman == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <label for="perkotaan"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Perkotaan</label>
                                    {{-- <input type="text" name="perkotaan" id="perkotaan"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> --}}
                                    <select name="perkotaan" id="perkotaan" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="Tidak Terdampak"
                                            {{ isset($data) && $data->perkotaan == 'Tidak Terdampak' ? 'selected' : '' }}>
                                            Tidak Terdampak</option>
                                        <option value="Sistem drainase terganggu"
                                            {{ isset($data) && $data->perkotaan == 'Sistem drainase terganggu' ? 'selected' : '' }}>
                                            Sistem drainase terganggu</option>
                                        <option value="Jalan utama tergenang namun masih bisa dilalui"
                                            {{ isset($data) && $data->perkotaan == 'Jalan utama tergenang namun masih bisa dilalui' ? 'selected' : '' }}>
                                            Jalan utama
                                            tergenang namun masih bisa dilalui</option>
                                        <option value="Aktivitas masyarakat terganggu"
                                            {{ isset($data) && $data->perkotaan == 'Aktivitas masyarakat terganggu' ? 'selected' : '' }}>
                                            Aktivitas masyarakat terganggu
                                        </option>
                                        <option value="Layanan publik lumpuh (transportasi,listrik,air bersih terganggu)"
                                            {{ isset($data) && $data->perkotaan == 'Layanan publik lumpuh (transportasi,listrik,air bersih terganggu)' ? 'selected' : '' }}>
                                            Layanan publik lumpuh (transportasi,listrik,air bersih terganggu)</option>
                                        <option value="Lainnya"
                                            {{ isset($data) && $data->perkotaan == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <label for="kawasan-industri"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Kawasan
                                        Industri</label>
                                    {{-- <input type="text" name="kawasan-industri" id="kawasan-industri"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> --}}
                                    <select name="kawasan-industri" id="kawasan-industri" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="Tidak Terdampak"
                                            {{ isset($data) && $data['kawasan-industri'] == 'Tidak Terdampak' ? 'selected' : '' }}>
                                            Tidak Terdampak</option>
                                        <option value="Produksi terganggu sebagian"
                                            {{ isset($data) && $data['kawasan-industri'] == 'Produksi terganggu sebagian' ? 'selected' : '' }}>
                                            Produksi terganggu sebagian</option>
                                        <option value="Akses Logistik terputus"
                                            {{ isset($data) && $data['kawasan-industri'] == 'Akses Logistik terputus' ? 'selected' : '' }}>
                                            Akses Logistik Terputus</option>
                                        <option value="Kerusakan alat/mesin produksi"
                                            {{ isset($data) && $data['kawasan-industri'] == 'Kerusakan alat/mesin produksi' ? 'selected' : '' }}>
                                            Kerusakan alat/mesin produksi
                                        </option>
                                        <option value="Aktivitas industri lumpuh total"
                                            {{ isset($data) && $data['kawasan-industri'] == 'Aktivitas industri lumpuh total' ? 'selected' : '' }}>
                                            Aktivitas industri lumpuh total
                                        </option>
                                        <option value="Lainnya"
                                            {{ isset($data) && $data['kawasan-industri'] == 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="sarana-prasarana"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Sarana/Prasarana</label>
                                    {{-- <input type="text" name="sarana-prasarana" id="sarana-prasarana"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> --}}
                                    <select name="sarana-prasarana" id="sarana-prasarana" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="Tidak Terdampak"
                                            {{ isset($data) && $data['sarana-prasarana'] == 'Tidak Terdampak' ? 'selected' : '' }}>
                                            Tidak Terdampak</option>
                                        <option value="Jalan desa/kecamatan tergenang"
                                            {{ isset($data) && $data['sarana-prasarana'] == 'Jalan desa/kecamatan tergenang' ? 'selected' : '' }}>
                                            Jalan desa/kecamatan tergenang
                                        </option>
                                        <option value="Sekolah dan fasilitas pendidikan rusak"
                                            {{ isset($data) && $data['sarana-prasarana'] == 'Sekolah dan fasilitas pendidikan rusak' ? 'selected' : '' }}>
                                            Sekolah dan fasilitas
                                            pendidikan rusak</option>
                                        <option value="Puskesmas / klinik tidak dapat beroprasi"
                                            {{ isset($data) && $data['sarana-prasarana'] == 'Puskesmas / klinik tidak dapat beroprasi' ? 'selected' : '' }}>
                                            Puskesmas / klinik tidak
                                            dapat beroperasi</option>
                                        <option value="Listrik Padam"
                                            {{ isset($data) && $data['sarana-prasarana'] == 'Listrik Padam' ? 'selected' : '' }}>
                                            Listrik Padam</option>
                                        <option value="Sistem air tidak berfungsi"
                                            {{ isset($data) && $data['sarana-prasarana'] == 'Sistem air tidak berfungsi' ? 'selected' : '' }}>
                                            Sistem air tidak berfungsi</option>
                                        <option value="Lainnya"
                                            {{ isset($data) && $data['sarana-prasarana'] == 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="pertanian"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Pertanian</label>
                                    {{-- <input type="text" name="pertanian" id="pertanian"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> --}}
                                    <select name="pertanian" id="pertanian" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="Tidak Terdampak"
                                            {{ isset($data) && $data['pertanian'] == 'Tidak Terdampak' ? 'selected' : '' }}>
                                            Tidak Terdampak</option>
                                        <option value="Sawah tergenang"
                                            {{ isset($data) && $data['pertanian'] == 'Sawah tergenang' ? 'selected' : '' }}>
                                            Sawah tergenang</option>
                                        <option value="Tanaman rusak"
                                            {{ isset($data) && $data['pertanian'] == 'Tanaman rusak' ? 'selected' : '' }}>
                                            Tanaman rusak</option>
                                        <option value="Gagal panen"
                                            {{ isset($data) && $data['pertanian'] == 'Gagal panen' ? 'selected' : '' }}>
                                            Gagal Panen</option>
                                        <option value="Peternakan Terdampak (Kehilangan ternak)"
                                            {{ isset($data) && $data['pertanian'] == 'Peternakan Terdampak (Kehilangan ternak)' ? 'selected' : '' }}>
                                            Peternakan Terdampak
                                            (Kehilangan ternak)</option>
                                        <option value="Lainnya"
                                            {{ isset($data) && $data['pertanian'] == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <label for="lama-ancaman-bahaya"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Lama
                                        Ancaman
                                        Bahaya</label>
                                    {{-- <input type="text" name="lama-ancaman-bahaya" id="lama-ancaman-bahaya"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> --}}
                                    <select name="lama-ancaman-bahaya" id="lama-ancaman-bahaya" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="< 6 jam"
                                            {{ isset($data) && $data['lama-ancaman-bahaya'] == '< 6 jam' ? 'selected' : '' }}>
                                            < 6 jam</option>
                                        <option value="6 - 12 jam"
                                            {{ isset($data) && $data['lama-ancaman-bahaya'] == '6 - 12 jam' ? 'selected' : '' }}>
                                            6 - 12 jam</option>
                                        <option value="12 - 24 jam"
                                            {{ isset($data) && $data['lama-ancaman-bahaya'] == '12 - 24 jam' ? 'selected' : '' }}>
                                            12 - 24 jam</option>
                                        <option value="1 hari"
                                            {{ isset($data) && $data['lama-ancaman-bahaya'] == '1 hari' ? 'selected' : '' }}>
                                            1 hari</option>
                                        <option value="3 hari"
                                            {{ isset($data) && $data['lama-ancaman-bahaya'] == '3 hari' ? 'selected' : '' }}>
                                            3 hari</option>
                                        <option value="Masih berlangsung hingga saat pelaporan"
                                            {{ isset($data) && $data['lama-ancaman-bahaya'] == 'Masih berlangsung hingga saat pelaporan' ? 'selected' : '' }}>
                                            Masih berlangsung hingga
                                            saat pelaporan</option>
                                    </select>

                                </div>

                                <br>
                                <h1 class="font-bold">5. Kondisi Sarana/Prasarana SDA</h1>
                                <div>
                                    <label for="sarpras"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Sarana/Prasarana
                                        SDA</label>
                                    <input type="text" value="{{ isset($data) ? $data->sarpras : old('sarpras') }}"
                                        name="sarpras" id="sarpras"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="tingkat_kerusakan"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Tingkat
                                        Kerusakan</label>
                                    <select name="tingkat_kerusakan" id="tingkat_kerusakan"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">-- Pilih Tingkat Kerusakan --</option>
                                        <option value="Berat"
                                            {{ isset($data) && $data->tingkat_kerusakan == 'Berat' ? 'selected' : '' }}>
                                            Berat</option>
                                        <option value="Sedang"
                                            {{ isset($data) && $data->tingkat_kerusakan == 'Sedang' ? 'selected' : '' }}>
                                            Sedang</option>
                                        <option value="Ringan"
                                            {{ isset($data) && $data->tingkat_kerusakan == 'Ringan' ? 'selected' : '' }}>
                                            Ringan</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="fungsi_layanan"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Fungsi
                                        Layanan</label>
                                    <select name="fungsi_layanan" id="fungsi_layanan"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">-- Pilih Fungsi Layanan --</option>
                                        <option value="TBSS"
                                            {{ isset($data) && $data->fungsi_layanan == 'TBSS' ? 'selected' : '' }}>Tidak
                                            berfungsi sama sekali</option>
                                        <option value="BDP"
                                            {{ isset($data) && $data->fungsi_layanan == 'BDP' ? 'selected' : '' }}>Dapat
                                            berfungsi dengan perbaikan</option>
                                        <option value="BDPR"
                                            {{ isset($data) && $data->fungsi_layanan == 'BDPR' ? 'selected' : '' }}>Masih
                                            berfungsi dengan perbaikan ringan</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="ancaman"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Ancaman
                                        Dampak</label>
                                    {{-- <input type="text" name="ancaman" id="ancaman"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> --}}
                                    <select name="ancaman" id="ancaman" 
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">-- Pilih Tingkat Ancaman Dampak --</option>
                                        <option value="Gangguan aliran air dan potensi banjir lanjutan"
                                            {{ isset($data) && $data->ancaman == 'Gangguan aliran air dan potensi banjir lanjutan' ? 'selected' : '' }}>
                                            Gangguan aliran air
                                            dan potensi banjir lanjutan</option>
                                        <option value="Terhambatnya distribusi air bersih"
                                            {{ isset($data) && $data->ancaman == 'Terhambatnya distribusi air bersih' ? 'selected' : '' }}>
                                            Terhambatnya distribusi air
                                            bersih</option>
                                        <option value="Kegagalan sistem pengendalian banjir"
                                            {{ isset($data) && $data->ancaman == 'Kegagalan sistem pengendalian banjir' ? 'selected' : '' }}>
                                            Kegagalan sistem pengendalian
                                            banjir</option>
                                        <option value="Ancaman terhadap keselamatan warga sekitar"
                                            {{ isset($data) && $data->ancaman == 'Ancaman terhadap keselamatan warga sekitar' ? 'selected' : '' }}>
                                            Ancaman terhadap
                                            keselamatan warga sekitar</option>
                                        <option value="Potensi kerusakan infrastruktur lainnya"
                                            {{ isset($data) && $data->ancaman == 'Potensi kerusakan infrastruktur lainnya' ? 'selected' : '' }}>
                                            Potensi kerusakan
                                            infrastruktur lainnya</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="rencana_aksi"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Rencana
                                        Aksi</label>
                                    <select name="rencana_aksi" id="rencana_aksi" 
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">-- Pilih Rencana Aksi --</option>
                                        <option value="PSLB"
                                            {{ isset($data) && $data->rencana_aksi == 'PSLB' ? 'selected' : '' }}>
                                            Penanggulangan sarana prasarana SDA yang rusak terkait
                                            langsung
                                            bencana</option>
                                        <option value="PSPT"
                                            {{ isset($data) && $data->rencana_aksi == 'PSPT' ? 'selected' : '' }}>
                                            Penanggulangan sarana prasarana SDA yang rusak sehingga
                                            pelayanan terganggu</option>
                                    </select>
                                </div>

                                <br>
                                <h1 class="font-bold">6. Penanganan Bahaya</h1>
                                <div>
                                    <label for="p_darurat"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Penanganan
                                        Darurat yang sudah dilakukan</label>
                                    {{-- <input type="text" name="p_darurat" id="p_darurat"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> --}}
                                    <select name="p_darurat" id="p_darurat" 
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">-- Pilih Penanganan Darurat yang di sudah dilakukan --</option>
                                        <option value="Evakuasi warga terdampak"
                                            {{ isset($data) && $data->p_darurat == 'Evakuasi warga terdampak' ? 'selected' : '' }}>
                                            Evakuasi warga terdampak</option>
                                        <option value="Pemasangan tanggul darurat"
                                            {{ isset($data) && $data->p_darurat == 'Pemasangan tanggul darurat' ? 'selected' : '' }}>
                                            Pemasangan tanggul darurat</option>
                                        <option value="Distribusi Logistik"
                                            {{ isset($data) && $data->p_darurat == 'Distribusi Logistik' ? 'selected' : '' }}>
                                            Distribusi Logistik</option>
                                        <option value="Penyediaan posko pengungsian"
                                            {{ isset($data) && $data->p_darurat == 'Penyediaan posko pengungsian' ? 'selected' : '' }}>
                                            Penyediaan posko pengungsian</option>
                                        <option value="Pemompaan dan penyedotan genangan air"
                                            {{ isset($data) && $data->p_darurat == 'Pemompaan dan penyedotan genangan air' ? 'selected' : '' }}>
                                            Pemompaan dan penyedotan
                                            genangan air</option>
                                        <option value="Pengamanan aset vital (listrik, jalan, jembatan)"
                                            {{ isset($data) && $data->p_darurat == 'Pengamanan aset vital (listrik, jalan, jembatan)' ? 'selected' : '' }}>
                                            Pengamanan aset
                                            vital (listrik, jalan, jembatan)</option>
                                        <option value="Peringatan dini ke masyarakat"
                                            {{ isset($data) && $data->p_darurat == 'Peringatan dini ke masyarakat' ? 'selected' : '' }}>
                                            Peringatan dini ke masyarakat
                                        </option>
                                        <option value="Lainnya"
                                            {{ isset($data) && $data->p_darurat == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <label for="sda"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Sumber
                                        daya yang tersedia di lokasi</label>
                                    {{-- <input type="text" name="sda" id="sda"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> --}}
                                    <select name="sda" id="sda" 
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">-- Pilih Sumber daya yang tersedia --</option>
                                        <option value="Tim relawan lokal"
                                            {{ isset($data) && $data->sda == 'Tim relawan lokal' ? 'selected' : '' }}>Tim
                                            relawan lokal</option>
                                        <option
                                            value="Peralatan pompa air"{{ isset($data) && $data->sda == 'Peralatan pompa air' ? 'selected' : '' }}>
                                            Peralatan pompa air</option>
                                        <option
                                            value="Tenda darurat"{{ isset($data) && $data->sda == 'Tenda darurat' ? 'selected' : '' }}>
                                            Tenda darurat</option>
                                        <option
                                            value="Stok logistik terbatas"{{ isset($data) && $data->sda == 'Stok logistik terbatas' ? 'selected' : '' }}>
                                            Stok logistik terbatas</option>
                                        <option
                                            value="Kendaraan evakuasi"{{ isset($data) && $data->sda == 'Kendaraan evakuasi' ? 'selected' : '' }}>
                                            Kendaraan evakuasi</option>
                                        <option
                                            value="Bantuan medis dasar"{{ isset($data) && $data->sda == 'Bantuan medis dasar' ? 'selected' : '' }}>
                                            Bantuan medis dasar</option>
                                        <option value="Lainnya"
                                            {{ isset($data) && $data->sda == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <label for="kendala"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Kendala/Hambatan</label>
                                    {{-- <input type="text" name="kendala" id="kendala"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> --}}
                                    <select name="kendala" id="kendala" 
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">-- Pilih Kendala / Hambatan --</option>
                                        <option value="Akses jalan terputus atau terendam"
                                            {{ isset($data) && $data->kendala == 'Akses jalan terputus atau terendam' ? 'selected' : '' }}>
                                            Akses jalan terputus atau
                                            terendam</option>
                                        <option value="Kurangnya tenaga relawan"
                                            {{ isset($data) && $data->kendala == 'Kurangnya tenaga relawan' ? 'selected' : '' }}>
                                            Kurang nya tenaga relawan</option>
                                        <option value="Terbatasnya logistik"
                                            {{ isset($data) && $data->kendala == 'Terbatasnya logistik' ? 'selected' : '' }}>
                                            Terbatasnya logistik</option>
                                        <option value="Gangguan jaringan komunikasi"
                                            {{ isset($data) && $data->kendala == 'Gangguan jaringan komunikasi' ? 'selected' : '' }}>
                                            Gangguan jaringan komunikasi</option>
                                        <option value="Cuaca ekstrem yang berkelanjutan"
                                            {{ isset($data) && $data->kendala == 'Cuaca ekstrem yang berkelanjutan' ? 'selected' : '' }}>
                                            Cuaca ekstrem yang berkelanjutan
                                        </option>
                                        <option value="Lainnya"
                                            {{ isset($data) && $data->kendala == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <label for="kebutuhan"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Kebutuhan
                                        Mendesak</label>
                                    {{-- <input type="text" name="kebutuhan" id="kebutuhan"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> --}}

                                    <select name="kebutuhan" id="kebutuhan"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">-- Pilih Kebutuhan Mendesak --</option>
                                        <option value="Logistik tambahan (Makanan, air, obat-obatan)"
                                            {{ isset($data) && $data->kebutuhan == 'Logistik tambahan (Makanan, air, obat-obatan)' ? 'selected' : '' }}>
                                            Logistik tambahan (Makanan, air, obat-obatan)</option>
                                        <option value="Tenda dan perlengkapan pengungsian"
                                            {{ isset($data) && $data->kebutuhan == 'Tenda dan perlengkapan pengungsian' ? 'selected' : '' }}>
                                            Tenda dan perlengkapan pengungsian</option>
                                        <option value="Peralatan penyedot air dan pompa"
                                            {{ isset($data) && $data->kebutuhan == 'Peralatan penyedot air dan pompa' ? 'selected' : '' }}>
                                            Peralatan penyedot air dan pompa</option>
                                        <option value="Tim medis dan tenaga kesehatan"
                                            {{ isset($data) && $data->kebutuhan == 'Tim medis dan tenaga kesehatan' ? 'selected' : '' }}>
                                            Tim medis dan tenaga kesehatan</option>
                                        <option value="Bahan bakar dan listrik darurat"
                                            {{ isset($data) && $data->kebutuhan == 'Bahan bakar dan listrik darurat' ? 'selected' : '' }}>
                                            Bahan bakar dan listrik darurat</option>
                                        <option value="Perahu karet / alat evakuasi"
                                            {{ isset($data) && $data->kebutuhan == 'Perahu karet / alat evakuasi' ? 'selected' : '' }}>
                                            Perahu karet / alat evakuasi</option>
                                        <option value="Lainnya"
                                            {{ isset($data) && $data->kebutuhan == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <label for="logistik"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Logistik</label>
                                    {{-- <input type="text" name="kebutuhan" id="kebutuhan"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> --}}

                                    <select name="logistik" id="logistik" 
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">-- Pilih Logistik --</option>
                                        <option value="Ya" {{isset($data) && $data->logistik == 'Ya' ? 'selected' : ''}}>Ya</option>
                                        <option value="Tidak" {{isset($data) && $data->logistik == 'Tidak' ? 'selected' : ''}}>Tidak</option>
                                    </select>
                                </div>
                                <br>
                                <h1 class="font-bold">7. Estimasi Anggaran</h1>
                                <div>
                                    <label for="estimasi_anggaran"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Estimasi Anggaran</label>
                                    {{-- <input type="text" name="kebutuhan" id="kebutuhan"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> --}}

                                    <select name="estimasi_anggaran" id="estimasi_anggaran" 
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">-- Pilih Estimasi Anggaran --</option>
                                        <option value="3" {{isset($data) && $data->estimasi_anggaran == '3' ? 'selected' : ''}}><= 250 juta</option>
                                        <option value="2" {{isset($data) && $data->estimasi_anggaran == '2' ? 'selected' : ''}}>> 250 juta sampai <= 500 juta</option>
                                        <option value="1" {{isset($data) && $data->estimasi_anggaran == '1' ? 'selected' : ''}}>> 500 juta</option>
                                    </select>
                                </div>
                                <br>
                                <h1 class="font-bold">8. Dokumentasi</h1>

                                @if (isset($data))
                                    <div class="grid grid-cols-4 gap-3" id="container-image">
                                        @foreach ($data->images as $item)
                                            <div class="row h-full" id="{{ $item->id }}">
                                                <img src="{{ asset($item->getImages($item->image_path)) }}"
                                                    class="w-full">
                                                <button type="button" id="{{ $item->id }}"
                                                    class="bg-red-500 w-full p-2 rounded-lg mt-2"
                                                    onclick="hapusReportImages(this.id)">Hapus</button>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <div>
                                    <input type="file" name="dokumentasi[]" id="dokumentasi" multiple
                                        class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="status_laporan"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Status
                                        Laporan</label>
                                    {{-- <input type="text" name="kebutuhan" id="kebutuhan"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> --}}

                                    <select name="status_laporan" id="status_laporan" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="0"
                                            {{ isset($data) && $data->status_laporan == '0' ? 'selected' : '' }}> Belum
                                            Ditangani</option>
                                        <option value="1"
                                            {{ isset($data) && $data->status_laporan == '1' ? 'selected' : '' }}> Dalam
                                            Penanganan</option>
                                        <option value="2"
                                            {{ isset($data) && $data->status_laporan == '2' ? 'selected' : '' }}> Sudah
                                            Ditangani</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="estimasi_selesai"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Estimasi
                                        Selesai</label>
                                    <input type="datetime-local"
                                        value="{{ isset($data) ? $data->estimasi_selesai : old('estimasi_selesai') }}"
                                        name="estimasi_selesai" id="estimasi_selesai"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="keterangan_laporan"
                                        class="mt-2 mb-1 block text-sm font-medium text-gray-900 dark:text-white">Keterangan
                                        laporan</label>
                                    <textarea cols="5" rows="10" type="datetime-local" name="keterangan_laporan" id="keterangan_laporan"
                                        placeholder="Keterangan Laporan"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ isset($data) ? $data->keterangan_laporan : old('keterangan_laporan') }}</textarea>
                                </div>
                                <input type="hidden" name="kdcpum" id="kdcpum" value="">
                                <br>
                                <button type="submit" style="background-color: #053c8f" id="btn_submit"
                                    class="mt-5 w-full text-white hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-800">
                                    Submit
                                </button>
                                <div class="flex">
                                    <button type="submit" name="submit_type" value="a" id="btn_submit"
                                        class="mt-4 w-full text-white bg-green-500 hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300 rounded-lg py-2.5 text-sm">
                                        Laporan Format A
                                    </button>

                                    {{-- <button type="submit" name="submit_type" value="b" id="btn_submit"
                                        class="ml-2 mt-4 w-full text-white bg-yellow-500 hover:bg-yellow-700 focus:outline-none focus:ring-4 focus:ring-yellow-300 rounded-lg py-2.5 text-sm">
                                        Laporan Format B
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection
@section('content-js')
    <script>
        function hapusReportImages(val) {
            $.ajax({
                'url': '{{ url('/reports') }}/' + val + '/delete_images',
                'method': 'GET',
                'success': function(data, status) {
                    $('#' + val).remove()
                }
            })
        }

       
        let thisDevicePosition = [];
        //Geolocations


        document.addEventListener("DOMContentLoaded", function() {
            var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            });

            var satelliteLayer = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                attribution: 'Google'
            });

            var map = L.map('map', {
                center: [{{ isset($data) ? $data->koordinat : '-3.4453, 114.8450' }}],
                zoom: 12,
                layers: [osmLayer]
            });



            var baseLayers = {
                "Peta Jalan": osmLayer,
                "Peta Satelit": satelliteLayer
            };

            L.control.layers(baseLayers, {}, {
                position: 'bottomleft'
            }).addTo(map);

           

            var marker;
            var batas = [];

            function InitializeBatas(){
                @foreach ($kec as $kc)
                var s = new L.GeoJSON.AJAX("{{ asset('uploads/geojson/' . $kc->geojson_file) }}", {
                    onEachFeature: function(f, l) {
                        var out = [];
                        batas.push(l)
                       setKDCPUMIFInside(marker,batas)
                    }
                }).addTo(map);
            @endforeach
            }
           
          
            // Tambahkan marker default
            function setDefaultMarker(position = null) {
               
                rays = [{{ isset($data) ? $data->koordinat : '-3.4102694826574798,114.85116505681636' }}]

                if (position != null) {
                    rays = position;
                }
                
                marker = L.marker(rays).addTo(map);
                map.panTo(new L.LatLng(rays[0], rays[1]))
                document.getElementById('koordinat').value = rays[0] + ',' + rays[1];
               
                setKDCPUMIFInside(marker, batas);
            }
            function setDefaultMarkerWithoutKDCPUM(position = null) {
              
                rays = [{{ isset($data) ? $data->koordinat : '-3.4102694826574798,114.85116505681636' }}]

                if (position != null) {
                    rays = position;
                }
                marker = L.marker(rays).addTo(map);
                map.panTo(new L.LatLng(rays[0], rays[1]))
                document.getElementById('koordinat').value = rays[0] + ',' + rays[1];
                
            }




            //Marker Sesuai Geolocation
                @if(!isset($data))
                    navigator.geolocation.getCurrentPosition(function(position) {
                        setDefaultMarker([position.coords.latitude, position.coords.longitude]);
                    }, function(e) {
                        setDefaultMarker(null);
                    });
                @else
                    
                    setDefaultMarker()
                @endif
                
            
                InitializeBatas();

            //Click Map 
            
            function setKDCPUMIFInside(marker, batas) {
                var isInside = false;
              
                for (let i = 0; i < batas.length; i++) {
                    if (batas[i].getBounds().contains(marker.getLatLng())) {
                        isInside = true;
                        $('#kdcpum').val(batas[i].feature.properties.KDCPUM)
                        $('#note-koordinat').html(
                        ''
                        )
                        $('#btn_submit').removeAttr('disabled')
                    }
                    
                }
              
                
                if (!isInside) {
                    $('#kdcpum').val('')
                    $('#note-koordinat').html(
                        '<small class="text-red-500">Titik Bencana tidak dalam batas wilayah kec / desa</small>'
                        )
                    $('#btn_submit').attr('disabled', 'true')
                }

            }


            function onMapClick(e) {
                //setDefaultMarker(e.latlng);

                marker.setLatLng(e.latlng);
                document.getElementById('koordinat').value = e.latlng.lat + ',' + e.latlng.lng;
                setKDCPUMIFInside(marker, batas);
            }
           
            map.on('click', onMapClick);
            

            // Fungsi untuk memperbarui posisi marker berdasarkan input koordinat
            document.getElementById('koordinat').addEventListener('input', function(e) {

                var value = e.target.value;
                var coords = value.split(',').map(coord => parseFloat(coord.trim()));

                if (coords.length === 2 && !isNaN(coords[0]) && !isNaN(coords[1])) {
                    var lat = coords[0];
                    var lng = coords[1];

                    // Perbarui posisi marker dan pusatkan peta
                    marker.setLatLng([lat, lng]);
                    map.setView([lat, lng], 13);
                    setKDCPUMIFInside(marker, batas);
                }
            });
            
        });
    </script>
@endsection
