@extends('layouts.app')

@section('content')
    <div class="relative">
        <div id="map" style="height: 90vh" class="w-full"></div>

        <div class="absolute top-5 right-5 bg-white p-4 rounded-lg shadow-lg w-80 max-h-80 overflow-y-auto">
            <ul>
                @if ($reports->isEmpty())
                    <li class="mb-2 text-gray-500 font-bold">Data tidak ditemukan</li>
                @else
                    @foreach ($reports as $priority => $groupedReports)
                        <li class="mb-2 mt-2 font-bold {{ $priority === 'Skala Prioritas 1' ? 'text-red-500' : 'text-gray-500' }}">
                            {{ $priority }}:
                        </li>
                        <ol class="pl-5 list-decimal">
                            @foreach ($groupedReports as $report)
                                <li>
                                    <b>{{ $report->lokasi }}</b> - {{ $report->jenis_bencana }}
                                </li>
                            @endforeach
                        </ol>
                    @endforeach
                @endif
            </ul>
 
            <!-- Box Legenda -->
            <div class="mt-4 p-2 bg-gray-100 rounded-md shadow">
                <p class="text-sm"><span class="text-red-500 font-bold">■</span> Skala Prioritas 1</p>
                <p class="text-sm"><span class="text-gray-500 font-bold">■</span> Skala Prioritas 2</p>
            </div>

            <div class="mt-4 text-left">
                <a href="{{ route('reports.generate', ['format' => 'c', 'id' => 'none']) }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Laporan Format C
                </a>
            </div>
        </div>
        
    </div>
    <section class="bg-gray-100 dark:bg-gray-900 h-dvh  z-1">
        <div class="flex flex-col items-center justify-center px-6 py-3 mx-auto h-auto lg:py-0">
            <div class="grid  lg:grid-cols-3 gap-4  pb-2 w-full mt-2">

                <div class="grid grid-rows-1 w-full gap-2">
                    <div class="w-full bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-800 dark:border-gray-700 dark:text-white"
                        style="height:225px">
                        <div class="p-2 space-y-4 md:space-y-6">
                            <div class="text-center">
                                <small>Potensi Bahaya Banjir</small>
                                <canvas id="pbb" style="max-height: 125px;"></canvas>
                            </div>
                            {{-- Chart 1 --}}
                           
                        </div>
                    </div>
                    <div class="w-full bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-800 dark:border-gray-700 dark:text-white"
                        style="height:225px">
                        <div class="p-2 space-y-4 md:space-y-6">
                            <div class="text-center">
                                <small>Potensi Penduduk Terpapar dan Kelompok Rentan Banjir</small>
                                <canvas id="ppt"style="max-height: 125px;"></canvas>
                            </div>
                            {{-- Chart 2 --}}
                            
                        </div>
                    </div>
                </div>


                <div
                    class="w-full bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-800 dark:border-gray-700 col-span-2">
                    <div class="relative p-0 space-y-4 md:space-y-6">
                        {{-- Map --}}
                            <div id="map" style="height: 450px; border: 1px solid #ccc; z-index: 0;"></div>                           
                    </div>
                </div>
                <div class="w-full bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-800 dark:border-gray-700 dark:text-white"
                    style="height:170px">
                    <div class="p-2 space-y-4 md:space-y-6">
                        <div class="text-center">
                            <small>Potensi Kerugian Fisik, Ekonomi dan Kerusakan Lingkungan</small>
                            <canvas id="pkf" style="max-height: 125px;"></canvas>
                        </div>
                        {{-- Chart 3 --}}

                    </div>
                </div>
                <div class="col-span-2">
                    <div class="grid gap-2 lg:grid-cols-5">
                        <div class="w-full bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-800 dark:border-gray-700 dark:text-white col-span-2"
                            style="height:170px">
                            <div class="p-2 space-y-4 md:space-y-6">
                                <div class="text-center">
                                    <small>Kapasitas Kecamatan Terhadap Bencana Banjir</small>
                                    <canvas id="kktbb" style="max-height: 125px;"></canvas>
                                </div>
                                {{-- Chart 3 --}}
                               
                            </div>
                        </div>
                        <div class="w-full bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-800 dark:border-gray-700 dark:text-white col-span-2"
                            style="height:170px">
                            <div class="p-2 space-y-4 md:space-y-6">
                                <div class="text-center">
                                    <small>Resiko Banjir Per Kecamatan</small>
                                    <canvas id="rbpk" style="max-height: 125px;"></canvas>
                                </div>
                                {{-- Chart 3 --}}
                               

                            </div>
                        </div>
                        <div class="w-full bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-800 dark:border-gray-700 dark:text-white"
                            style="height:170px;">
                            <div class="p-2 space-y-4 md:space-y-6">
                                <div class="text-center">
                                    <small>Kelas Resiko Banjir</small>
                                </div>
                                <div class="container-resiko">

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script>
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
            center: [-3.4453, 114.8450], // Sesuaikan dengan lokasi awal
            zoom: 12,
            layers: [osmLayer]
        });

        var baseLayers = {
            "Peta Jalan": osmLayer,
            "Peta Satelit": satelliteLayer
        };
        
        L.control.layers(baseLayers, {}, { position: 'bottomleft' }).addTo(map);
 
        @php $index = 0; @endphp
        @foreach ($reports as $priority => $groupedReports)
            @foreach ($groupedReports as $report)
                var priority = '{{ $priority }}';
                var color = priority === 'Skala Prioritas 1' ? 'red' : '#6B7280';
                var label = '{{ chr(65 + $index) }}'; // Label A, B, C...

                var marker = L.marker([{{ $report->koordinat }}]).addTo(map);

                marker.setIcon(L.divIcon({
                    className: 'leaflet-marker-icon',
                    iconAnchor: [10, 10],
                    html: `<span style="display:inline-block;padding:5px 10px;border-radius:50%;background-color:${color};color:white;font-weight:bold;">${label}</span>`
                }));

                marker.bindPopup(`<b>${priority}</b><br>{{ $report->lokasi }}<br>{{ $report->jenis_bencana }}`);

                @php $index++; @endphp
            @endforeach
        @endforeach
    </script>
@endsection