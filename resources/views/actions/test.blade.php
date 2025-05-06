@extends('layouts.app')

@section('content')
    <section class="bg-gray-100 dark:bg-gray-900 h-dvh  z-1">
        <div class="flex flex-col items-center justify-center px-6 py-3 mx-auto h-auto lg:py-0">
            <div class="grid  lg:grid-cols-4 gap-4 pb-2 w-full mt-2">

                <div class="grid grid-rows-1 w-full gap-1">
                    <div class="w-full bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-800 dark:border-gray-700 dark:text-white"
                        style="height:225px">
                        <div class="p-2 space-y-4 md:space-y-6">
                            <div class="text-center">
                                <small>Lokasi Bencana</small>
                                <div id="lokasi_bencana" class="text-left mt-2 text-xs">

                                </div>
                            </div>
                            {{-- Chart 1 --}}

                        </div>
                    </div>
                    <div class="w-full bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-800 dark:border-gray-700 dark:text-white"
                        style="height:225px">
                        <div class="p-2 space-y-4 md:space-y-6">
                            <div class="text-center">
                                <small>Korban Bencana</small>
                                <canvas id="kb"style="max-height: 150px;"></canvas>
                            </div>
                            {{-- Chart 2 --}}

                        </div>
                    </div>
                </div>


                <div
                    class="w-full bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-800 dark:border-gray-700 col-span-3">
                    <div class="relative p-0 space-y-4 md:space-y-6">
                        {{-- Map --}}
                        <div id="map" style="height: 450px; border: 1px solid #ccc; z-index: 0;" class="w-full"></div>


                        <div class="absolute top-5 right-5">
                            <form action="{{ route('reports.generateAsPriority') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="bg-white p-4 rounded-lg shadow-lg w-80 max-h-50 overflow-auto  mb-3">
                                    <input type="hidden" id="format" name="format" value="b">
                                    <ul class="">
                                        @if ($reports->isEmpty())
                                            <li class="mb-2 text-gray-500 font-bold">Data tidak ditemukan</li>
                                        @else
                                            @foreach ($reports as $priority => $groupedReports)
                                                @if ($priority === 'Skala Prioritas 1')
                                                    <li
                                                        class="mb-2 mt-2 font-bold {{ $priority === 'Skala Prioritas 1' ? 'text-red-500' : 'text-gray-500' }}">
                                                        {{ $priority }}:
                                                    </li>
                                                    <ol class="pl-5 list-decimal max-h-20 overflow-y-auto">
                                                        @foreach ($groupedReports->sortByDesc('logistik') as $report)
                                                            <li>
                                                               
                                                                <label
                                                                    for="{{$report->id}}"><b> <span id="charat_{{$report->id}}"><span>{{ $report->lokasi }}</b> -
                                                                    {{ $report->jenis_bencana }}</label>
                                                                    <input type="radio" value="{{$report->id}}"
                                                                    class="accent-black show_marker_{{$report->id}}" name="first_priority"
                                                                    id="{{$report->id}}" />
                                                            </li>
                                                        @endforeach
                                                    </ol>
                                                @endif
                                            @endforeach
                                        @endif
                                    </ul>

                                    <!-- Box Legenda -->
                                    {{-- <div class="mt-4 p-2 bg-gray-100 rounded-md shadow">
                                    <p class="text-sm"><span class="text-red-500 font-bold">■</span> Skala Prioritas 1</p>
                                    <p class="text-sm"><span class="text-gray-500 font-bold">■</span> Skala Prioritas 2</p>
                                </div> --}}

                                    <div class="mt-4 text-left">
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Laporan
                                            Format B</button>
                                        {{-- <a href="{{ route('reports.generate', ['format' => 'c', 'id' => 'none']) }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Laporan Format C
                    </a> --}}
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('reports.generateAsCheck') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="bg-white p-4 rounded-lg shadow-lg w-80 max-h-80 overflow-auto  mb-3">
                                    <input type="hidden" id="format" name="format" value="c">
                                    <ul>
                                        @if ($reports->isEmpty())
                                            <li class="mb-2 text-gray-500 font-bold">Data tidak ditemukan</li>
                                        @else
                                            @foreach ($reports as $priority => $groupedReports)
                                                @if ($priority === 'Skala Prioritas 2')
                                                    <li
                                                        class="mb-2 mt-2 font-bold {{ $priority === 'Skala Prioritas 1' ? 'text-red-500' : 'text-gray-500' }}">
                                                        {{ $priority }}:
                                                    </li>
                                                    <ol class="pl-5 list-decimal  max-h-20 overflow-y-auto">
                                                        @foreach ($groupedReports as $report)
                                                            <li>
                                                              
                                                                <label
                                                                    for="{{ $report->id }}"><b><span id="charat_{{$report->id}}"><span> {{ $report->lokasi }}</b>
                                                                    -
                                                                    {{ $report->jenis_bencana }} <input type="checkbox"
                                                                        class="accent-black show_marker_{{$report->id}}" name="{{ $report->id }}"
                                                                        id="{{ $report->id }}" /></label>
                                                                       
                                                            </li>
                                                        @endforeach
                                                    </ol>
                                                @endif
                                            @endforeach
                                        @endif
                                    </ul>

                                    <!-- Box Legenda -->
                                    {{-- <div class="mt-4 p-2 bg-gray-100 rounded-md shadow">
                                    <p class="text-sm"><span class="text-red-500 font-bold">■</span> Skala Prioritas 1</p>
                                    <p class="text-sm"><span class="text-gray-500 font-bold">■</span> Skala Prioritas 2</p>
                                </div> --}}

                                    <div class="mt-4 text-left">
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Laporan
                                            Format C</button>
                                        {{-- <a href="{{ route('reports.generate', ['format' => 'c', 'id' => 'none']) }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Laporan Format C
                    </a> --}}
                                    </div>
                                </div>
                            </form>
                        </div>



                    </div>
                </div>
                <div class="w-full bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-800 dark:border-gray-700 dark:text-white"
                    style="height:225px">
                    <div class="p-2 space-y-4 md:space-y-6">
                        <div class="text-center">
                            <small>Kerusakan Bencana</small>
                            <canvas id="kkb" style="max-height: 150px;"></canvas>
                        </div>
                        {{-- Chart 3 --}}

                    </div>
                </div>
                <div class="col-span-3">
                    <div class="grid gap-2 lg:grid-cols-3">
                        <div class="w-full bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-800 dark:border-gray-700 dark:text-white "
                            style="height:225px">
                            <div class="p-2 space-y-4 md:space-y-6">
                                <div class="text-center">
                                    <small>Bahaya Bencana</small>
                                    <div id="bahaya_bencana" class="text-xs text-left" style="max-height: 150px;overflow:auto;">

                                    </div>
                                </div>
                                {{-- Chart 3 --}}

                            </div>
                        </div>
                        <div class="w-full bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-800 dark:border-gray-700 dark:text-white "
                            style="height:225px">
                            <div class="p-2 space-y-4 md:space-y-6">
                                <div class="text-center">
                                    <small>Kondisi Sarana Dan Prasarana SDA</small>
                                    <div id="kondisi_sps" class="text-xs text-left" style="max-height: 150px;overflow:auto;"></div>
                                </div>
                                {{-- Chart 3 --}}


                            </div>
                        </div>
                        <div class="w-full bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-800 dark:border-gray-700 dark:text-white "
                            style="height:225px;">
                            <div class="p-2 space-y-4 md:space-y-6">
                                <div class="text-center">
                                    <small>Penanggulangan Bahaya</small>
                                    <div id="pb" class="text-xs text-left" style="max-height: 150px;overflow:auto;"></div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <script src="{{ asset('') }}assets/js/Chart.min.js"></script>
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
        L.control.layers(baseLayers, {}, {
            position: 'bottomleft'
        }).addTo(map);

        function setChart(id, areaChartData = {}) {
            var barChartCanvas = $('#' + id).get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)

            for (let i = 0; i < areaChartData.datasets.length; i++) {
                barChartData.datasets[i] = areaChartData.datasets[i]
            }
            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: true,
                legend: false,
            }

            return new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })
        }

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
                $('#charat_{{$report->id}}').append(' ( '+label+' ) ')
                $('.show_marker_{{$report->id}}').on('click',function(e){
                    map.flyTo([{{$report->koordinat}}]);
                })
                marker.on('click', function(e) {
                    $('#lokasi_bencana').html(
                        '<table class="w-full border dark:border-white"><thead><th class="border dark:border-white">No</th><th class="border dark:border-white">Nama</th><th class="border dark:border-white">Value</th></thead><tbody><tr><td class="border dark:border-white">1.</td><td class="border dark:border-white">Lokasi Kejadian</td><td class="border dark:border-white"> {{ $report->lokasi }}</td></tr><tr><td class="border dark:border-white">2.</td><td class="border dark:border-white">Koordinat</td><td class="border dark:border-white"> {{ $report->koordinat }}</td></tr></tbody></table>'
                    )
                    $('#bahaya_bencana').html(
                        '  <table class="w-full h-full border dark:border-white"><thead><th class="border dark:border-white">No</th><th class="border dark:border-white">Nama</th><th class="border dark:border-white">Value</th></thead><tbody><tr><td class="border dark:border-white">1.</td><td class="border dark:border-white">Pemukiman</td><td class="border dark:border-white"> {{ $report->pemukiman }}</td></tr><tr><td class="border dark:border-white">2.</td><td class="border dark:border-white">Perkotaan</td><td class="border dark:border-white"> {{ $report->perkotaan }}</td></tr><tr><td class="border dark:border-white">3.</td><td class="border dark:border-white">Kawasan Industri</td><td class="border dark:border-white"> {{ $report->getVal('kawasan-industri') }}</td></tr><tr><td class="border dark:border-white">4.</td><td class="border dark:border-white">Sarana Prasarana</td><td class="border dark:border-white"> {{ $report->getVal('sarana-prasarana') }}</td></tr><tr><td class="border dark:border-white">5.</td><td class="border dark:border-white">Pertanian</td><td class="border dark:border-white"> {{ $report->getVal('pertanian') }}</td></tr><tr><td class="border dark:border-white">6.</td><td class="border dark:border-white">Lama Ancaman Bahaya</td><td class="border dark:border-white"> {{ $report->getVal('lama-ancaman-bahaya') }}</td></tr></tbody></table>'
                    )
                    $('#kondisi_sps').html(
                        '<table class="w-full h-full border dark:border-white"><thead><th class="border dark:border-white">No</th><th class="border dark:border-white">Nama</th><th class="border dark:border-white">Value</th></thead><tbody><tr><td class="border dark:border-white">1.</td><td class="border dark:border-white">Sarana dan Prasarana SDA</td><td class="border dark:border-white"> {{ $report->sarpras }}</td></tr><tr><td class="border dark:border-white">2.</td><td class="border dark:border-white">Tingkat Kerusakan</td><td class="border dark:border-white"> {{ $report->tingkat_kerusakan }}</td></tr><tr><td class="border dark:border-white">3.</td><td class="border dark:border-white">Fungsi Layanan</td><td class="border dark:border-white"> {{ $report->fungsi_layanan }}</td></tr><tr><td class="border dark:border-white">4.</td><td class="border dark:border-white">Ancaman Dampak</td><td class="border dark:border-white"> {{ $report->getVal('ancaman') }}</td></tr><tr><td class="border dark:border-white">5.</td><td class="border dark:border-white">Rencana Aksi</td><td class="border dark:border-white"> {{ $report->getVal('rencana_aksi') }}</td></tr></tbody></table>'
                    )
                    $('#pb').html(
                        '<table class="w-full h-full border dark:border-white">        <thead>            <th class="border dark:border-white">No</th>            <th class="border dark:border-white">Nama</th>            <th class="border dark:border-white">Value</th>        </thead>        <tbody>            <tr>                <td class="border dark:border-white">1.</td>                <td class="border dark:border-white">Penanganan darurat yang sudah dilakukan</td>                <td class="border dark:border-white"> {{ $report->p_darurat }}</td>            </tr>            <tr>                <td class="border dark:border-white">2.</td>                <td class="border dark:border-white">Sumber daya yang tersedia di lokasi</td>                <td class="border dark:border-white"> {{ $report->sda }}</td>            </tr>            <tr>                <td class="border dark:border-white">3.</td>                <td class="border dark:border-white">Kendala / Hambatan</td>                <td class="border dark:border-white"> {{ $report->kendala }}</td>            </tr>            <tr>                <td class="border dark:border-white">4.</td>                <td class="border dark:border-white">Kebutuhan Mendesak</td>                <td class="border dark:border-white"> {{ $report->kebutuhan }}</td>            </tr>        </tbody>    </table>'
                    )

                


                    var kb_data = {
                        labels: ['Meninggal', 'Luka Berat', 'Luka Ringan', 'Hilang/Hanyut', 'Mengungsi'],
                        datasets: [{
                            label: 'Korban Bencana',
                            backgroundColor: ['red',
                                'pink', 'yellow', 'red', 'green'
                            ],
                            borderColor: 'rgba(60,141,188,0.8)',
                            data: [{{ $report->meninggal }}, {{ $report->luka_berat }},
                                {{ $report->luka_ringan }}, {{ $report->hilang }},
                                {{ $report->mengungsi }}
                            ]
                        }]
                    }
                    var kbChart = setChart('kb', kb_data);


                    var kkb_data = {
                        labels: ['Rumah', 'Fasum/Faskes', 'Sawah/Lahan Pertanian', 'Kantor', 'Jalan/Jembatan'],
                        datasets: [{
                            label: 'Kerusakan Bencana',
                            backgroundColor: ['red',
                                'pink', 'yellow', 'red', 'green'
                            ],
                            borderColor: 'rgba(60,141,188,0.8)',
                            data: [{{ $report->rumah }}, {{ $report->getVal('fasum-faskes') }},
                                {{ $report->getVal('sawah-lahan-pertanian') }},
                                {{ $report->getVal('kantor') }},
                                {{ $report->getVal('jalan-jembatan') }}
                            ]
                        }]
                    }

                    var kkbChart = setChart('kkb', kkb_data);
                })

                @php $index++; @endphp
            @endforeach
        @endforeach
    </script>
@endsection
