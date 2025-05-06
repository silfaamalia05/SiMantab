<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script src="{{ asset('') }}assets/js/leaflet-panel-layers.js"></script>
    <script src="{{ asset('') }}assets/js/leaflet.ajax.js"></script>
    <link rel="stylesheet" href="{{ asset('') }}assets/css/leaflet-panel-layers.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('storage/simantab.png') }}" type="image/x-icon">
    <title>{{ config('app.name', 'SiMantab') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('') }}assets/js/jquery.min.js"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900">
    <div id="app ">
        <nav class=" bg-white p-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('storage/simantab.png') }}" alt="SiMantab Logo" class="h-8 mr-3">
                    </a>
                </div>
                <div class="flex items-center space-x-6 px-4" style="color:#053c8f">
                    <a href="{{ url('/dashboard') }}" class="hover:underline">Dashboard</a>
                    @if (in_array(auth()->user()->role, ['ADMIN']))
                        <div class="relative group">
                            <a href="#" >Base Layer</a>
                          <div class=" absolute z-10 hidden bg-grey-200 group-hover:block">
                            <div class="px-2 pt-2 pb-4 bg-white shadow-lg " style="width: 200px;">
                                 <div class="dropdown-menu z-1000">
                                   <ul>
                                   <li><a href="{{route('batas_kab_kota.index')}}" class="hover:underline dropdown-item">Kab / Kota </a></li>
                                   <li><a href="{{route('batas_kec_desa.index')}}" class="hover:underline dropdown-item">Kecamatan </a></li>
                                   <li><a href="{{route('batas_kel_desa.index')}}" class="hover:underline dropdown-item">Kel / Desa </a></li>
                                   <li><a href="{{route('jaringan_sungai.index')}}" class="hover:underline dropdown-item">Jaringan Sungai </a></li>
                                   <li><a href="{{route('jenis_tanah.index')}}" class="hover:underline dropdown-item">Jenis Tanah </a></li>
                                   <li><a href="{{route('morfologi.index')}}" class="hover:underline dropdown-item">Morfologi </a></li>
                                   <li><a href="{{route('kelerengan.index')}}" class="hover:underline dropdown-item">Kelerengan </a></li>
                                   <li><a href="{{route('kawasan_pemukiman.index')}}" class="hover:underline dropdown-item">Kawasan Pemukiman </a></li>
                                   <ul>
                                 </div>
                               </div>
                           </div>
                         </div>
                    @endif
                    @if (in_array(auth()->user()->role, ['ADMIN']))
                        <a href="{{route('data_banjir.index')}}" class="hover:underline">Data Banjir</a>
                    @endif
                    @if (in_array(auth()->user()->role, ['ADMIN']))
                    <div class="relative group">
                        <a href="#" >Logistik </a>
                      <div class=" absolute z-10 hidden bg-grey-200 group-hover:block">
                        <div class="px-2 pt-2 pb-4 bg-white shadow-lg " style="width: 300px;">
                             <div class="dropdown-menu z-1000">
                               <ul>
                               <li><a href="{{route('kategori_logistik.index')}}" class="hover:underline dropdown-item">Kategori Logistik </a></li>
                               <li><a href="{{route('logistik.index')}}" class="hover:underline dropdown-item">Data Logistik</a></li>
                             <ul>
                             </div>
                           </div>
                       </div>
                     </div>
                      
                    @endif
                    @if (in_array(auth()->user()->role, ['ADMIN']))
                        <a href="{{route('infrastruktur.index')}}" class="hover:underline">Infrastruktur</a>
                    @endif
                    @if (in_array(auth()->user()->role, ['ADMIN']))
                    <div class="relative group">
                        <a href="#" >Data Tabulasi </a>
                      <div class=" absolute z-10 hidden bg-grey-200 group-hover:block">
                        <div class="px-2 pt-2 pb-4 bg-white shadow-lg " style="width: 300px;">
                             <div class="dropdown-menu z-1000">
                               <ul>
                               <li><a href="{{route('kapasitas_banjir')}}" class="hover:underline dropdown-item">Kapasitas Banjir </a></li>
                               <li><a href="{{route('potensi_kerugian')}}" class="hover:underline dropdown-item">Potensi Kerugian Banir </a></li>
                               <li><a href="{{route('potensi_penduduk_terpapar')}}" class="hover:underline dropdown-item">Potensi Penduduk Terpapar </a></li>
                               <li><a href="{{route('tabulasi_bahaya')}}" class="hover:underline dropdown-item">Tabulasi Bahaya Banjir </a></li>
                               <li><a href="{{route('tabulasi_resiko')}}" class="hover:underline dropdown-item">Tabulasi Resiko Banjir </a></li>
                               <ul>
                             </div>
                           </div>
                       </div>
                     </div>
                @endif
                @if (in_array(auth()->user()->role, ['INTERNALBWS','SATGAS']))
                        <a href="{{ url('/laporan') }}" class="hover:underline">Laporan</a>
                    @endif
                    @if (in_array(auth()->user()->role, ['ADMIN']))
                        <a href="{{ url('/reports') }}" class="hover:underline">Laporan</a>
                    @endif
                    @if (in_array(auth()->user()->role, ['ADMIN', 'STAKEHOLDER']))
                        <a href="{{ url('/actions') }}" class="hover:underline">Aksi</a>
                    @endif
                    @if (in_array(auth()->user()->role, ['ADMIN']))
                        <a href="{{ url('/request-users') }}" class="hover:underline">Request Register</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:underline">Logout</button>
                    </form>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
    @yield('content-js')
</body>

</html>
