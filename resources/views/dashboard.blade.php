@extends('layouts.app')

@section('content')
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
                        <div class="absolute bottom-5 left-5 text-xs" id="legendContainer">

                        </div>
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
@endsection
@section('content-js')
    <script src="{{ asset('') }}assets/js/Chart.min.js"></script>
    <script>
        const map = L.map('map', {
            zoomControl: false,
            center: [-3.2482059706531814, 115.04433058806565],
            zoom: 9,

        });
        var baseLayers = [{
            active: true,
            name: "OSM",
            layer: L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 32,
            })

        }, {
            active: true,
            name: "Satelite",
            layer: L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                maxZoom: 32,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            })
        }];



        let overlays = [{
                group: "Kab Kota",
                collapsed: true,
                layers: [
                    @foreach ($batas_kab_kota as $bkk)
                        {
                            active: false,
                            name: '{{ $bkk->WADMKK }}',
                            layer: new L.GeoJSON.AJAX(
                                "{{ asset('uploads/geojson/' . $bkk->geojson_file) }}", {
                                    onEachFeature: function(f, l) {
                                        var out = [];
                                        if (f.properties) {
                                            out.push("Provinsi: " + f.properties['WADMPR']);
                                            out.push("Kab / Kota: " + f.properties['WADMKK']);
                                            l.bindPopup(out.join("<br />"));
                                        }
                                        l.on({
                                            click: function(e) {
                                                //Show Chart in card
                                            },
                                            dbblick: function(e) {
                                                map.fitBounds(e.target.getBounds())
                                            }
                                        })
                                    },
                                    style: {
                                        fillColor: '{{ $bkk->style }}',
                                        weight: 2,
                                        opacity: 1,
                                        color: 'white',
                                        dashArray: '3',
                                        fillOpacity: 0.7
                                    }
                                })
                        },
                    @endforeach
                ]
            },
            {
                group: "Kec Desa",
                collapsed: true,
                layers: [
                    @foreach ($batas_kec_desa as $bkk)
                        {
                            active: true,
                            name: '{{ $bkk->WADMKC }}',
                            layer: new L.GeoJSON.AJAX(
                                "{{ asset('uploads/geojson/' . $bkk->geojson_file) }}", {
                                    onEachFeature: function(f, l) {
                                        var out = [];

                                        if (f.properties) {
                                            out.push("Provinsi: " + f.properties['WADMPR']);
                                            out.push("Kab / Kota: " + f.properties['WADMKK']);
                                            out.push("Kecamatan: " + f.properties['WADMKC']);
                                            l.bindPopup(out.join("<br />"));
                                        }
                                        l.on({
                                            click: function(e) {
                                                var pbbData = {
                                                    labels: ['Rendah', 'Sedang',
                                                        'Tinggi'
                                                    ],
                                                    datasets: [{
                                                        label: 'Luas Bahaya (ha)',
                                                        backgroundColor: [
                                                            'green',
                                                            'yellow', 'red'
                                                        ],
                                                        borderColor: 'rgba(60,141,188,0.8)',
                                                        data: [
                                                            {{ isset($bkk->TabulasiBahayaBanjir->lb_rendah) ? $bkk->TabulasiBahayaBanjir->lb_rendah : 0 }},
                                                            {{ isset($bkk->TabulasiBahayaBanjir->lb_sedang) ? $bkk->TabulasiBahayaBanjir->lb_sedang : 0 }},
                                                            {{ isset($bkk->TabulasiBahayaBanjir->lb_tinggi) ? $bkk->TabulasiBahayaBanjir->lb_tinggi : 0 }}
                                                        ]
                                                    }]
                                                }
                                                setpbbChart(pbbData)

                                                var pptData = {
                                                    labels: ['Penduduk Terpapar',
                                                        'Kelompok Umur Rentan',
                                                        'Penduduk Disabilitas',
                                                        'Penduduk Miskin'
                                                    ],
                                                    datasets: [{
                                                        label: 'Penduduk Terpapar',
                                                        backgroundColor: 'blue',
                                                        borderColor: 'rgba(60,141,188,0.8)',
                                                        data: [
                                                            {{ isset($bkk->PotensiPendudukTerpapar->penduduk_terpapar) ? $bkk->PotensiPendudukTerpapar->penduduk_terpapar : 0 }},
                                                            {{ isset($bkk->PotensiPendudukTerpapar->kelompok_umur_rentan) ? $bkk->PotensiPendudukTerpapar->kelompok_umur_rentan : 0 }},
                                                            {{ isset($bkk->PotensiPendudukTerpapar->penduduk_disabilitas) ? $bkk->PotensiPendudukTerpapar->penduduk_disabilitas : 0 }},
                                                            {{ isset($bkk->PotensiPendudukTerpapar->penduduk_miskin) ? $bkk->PotensiPendudukTerpapar->penduduk_miskin : 0 }}
                                                        ]
                                                    }]
                                                }
                                                setpptChart(pptData)

                                                var pkfdata = {
                                                    labels: ['Kerugian Fisik',
                                                        'Kerugian Ekonomi',
                                                        'Potensi Kerusakan Lingkungan'
                                                    ],
                                                    datasets: [{
                                                        label: 'Potensi Kerugian Fisik,Ekonomi dan Kerusakan Lingkungan',
                                                        backgroundColor: 'blue',
                                                        borderColor: 'rgba(60,141,188,0.8)',
                                                        data: [
                                                            {{ isset($bkk->PotensiKerugian->kerugian_fisik) ? $bkk->PotensiKerugian->kerugian_fisik : 0 }},
                                                            {{ isset($bkk->PotensiKerugian->kerugian_ekonomi) ? $bkk->PotensiKerugian->kerugian_ekonomi : 0 }},
                                                            {{ isset($bkk->PotensiKerugian->potensi_kerusakan_lingkungan) ? $bkk->PotensiKerugian->potensi_kerusakan_lingkungan : 0 }}
                                                        ]
                                                    }]
                                                }
                                                setpkfChart(pkfdata)

                                                var rbpkData = {
                                                    labels: ['Rendah', 'Sedang',
                                                        'Tinggi'
                                                    ],
                                                    datasets: [{
                                                        label: 'Rendah',
                                                        backgroundColor: [
                                                            'green',
                                                            'yellow', 'red'
                                                        ],
                                                        borderColor: 'rgba(60,141,188,0.8)',
                                                        data: [
                                                            {{ isset($bkk->TabulasiResikoBanjir->lb_rendah) ? $bkk->TabulasiResikoBanjir->lb_rendah : 0 }},
                                                            {{ isset($bkk->TabulasiResikoBanjir->lb_sedang) ? $bkk->TabulasiResikoBanjir->lb_sedang : 0 }},
                                                            {{ isset($bkk->TabulasiResikoBanjir->lb_tinggi) ? $bkk->TabulasiResikoBanjir->lb_tinggi : 0 }}
                                                        ]
                                                    }]
                                                }
                                                setrbpkChart(rbpkData)

                                                var kktbbData = {
                                                    labels: ['Index Ketahanan',
                                                        'Index Kesiapsiagaan',
                                                        'Index Kapasitas'
                                                    ],
                                                    datasets: [{
                                                        label: 'Index Ketahanan',
                                                        backgroundColor: 'blue',
                                                        borderColor: 'rgba(60,141,188,0.8)',
                                                        data: [
                                                            {{ isset($bkk->KapasitasBanjir->index_ketahanan_daerah) ? $bkk->KapasitasBanjir->index_ketahanan_daerah : 0 }},
                                                            {{ isset($bkk->KapasitasBanjir->index_kesiapsiagaan) ? $bkk->KapasitasBanjir->index_kesiapsiagaan : 0 }},
                                                            {{ isset($bkk->KapasitasBanjir->index_kapasitas) ? $bkk->KapasitasBanjir->index_kapasitas : 0 }}

                                                        ]
                                                    }]
                                                }
                                                setkktbbChart(kktbbData)
                                                html = '';
                                                switch (
                                                    '{{ isset($bkk->TabulasiResikoBanjir->kelas) && $bkk->TabulasiResikoBanjir->kelas ? $bkk->TabulasiResikoBanjir->kelas : 0 }}'
                                                ) {
                                                    case 'Rendah':
                                                        html =
                                                            '<div class="bg-green-500 w-full p-2"></div><p class="text-center">Rendah</p>'
                                                        break;
                                                    case 'Sedang':
                                                        html =
                                                            '<div class="bg-yellow-500 w-full p-2"></div><p class="text-center">Sedang</p>'
                                                        break;
                                                    case 'Tinggi':
                                                        html =
                                                            '<div class="bg-red-500 w-full p-2"></div><p class="text-center">Tinggi</p>'
                                                        break;
                                                    default:
                                                        html =
                                                            '<div class="bg-gray-500 w-full p-2"></div><p class="text-center">Belum Ada Data</p>'
                                                        break;
                                                }
                                                $('.container-resiko').html(
                                                    html
                                                );


                                            },
                                            dbblick: function(e) {
                                                map.fitBounds(e.target.getBounds())
                                            }
                                        })
                                    },
                                    style: {
                                        fillColor: '{{ $bkk->style }}',
                                        weight: 2,
                                        opacity: 1,
                                        color: 'white',
                                        dashArray: '3',
                                        fillOpacity: 0.7
                                    }
                                })
                        },
                    @endforeach
                ]
            },
            {
                group: "Kel / Desa",
                collapsed: true,
                layers: [
                    @foreach ($batas_kel_desa as $bkk)
                        {
                            active: false,
                            name: '{{ $bkk->nama_batas }}',
                            layer: new L.GeoJSON.AJAX(
                                "{{ asset('uploads/geojson/' . $bkk->geojson_file) }}", {
                                    onEachFeature: function(f, l) {
                                        var out = [];
                                        if (f.properties) {
                                            out.push("Kelurahan: " + f.properties['WADMKD']);
                                            l.bindPopup(out.join("<br />"));
                                        }
                                        l.on({
                                            click: function(e) {
                                                //Show Chart in card
                                            },
                                            dbblick: function(e) {
                                                map.fitBounds(e.target.getBounds())
                                            }
                                        })
                                    },
                                    style: {
                                        fillColor: '{{ $bkk->style }}',
                                        weight: 2,
                                        opacity: 1,
                                        color: 'white',
                                        dashArray: '3',
                                        fillOpacity: 0.7
                                    }
                                })
                        },
                    @endforeach
                ]
            },
            {
                group: "Jaringan Sungai",
                collapsed: true,
                layers: [
                    @foreach ($jaringan_sungai as $bkk)
                        {
                            active: false,
                            name: '{{ $bkk->nama_jaringan_sungai }}',
                            layer: new L.GeoJSON.AJAX(
                                "{{ asset('uploads/geojson/' . $bkk->geojson_file) }}", {
                                    onEachFeature: function(f, l) {
                                        var out = [];
                                        if (f.properties) {
                                            out.push("Nama Objek: " + f.properties['NAMOBJ']);
                                            l.bindPopup(out.join("<br />"));
                                        }
                                        l.on({
                                            click: function(e) {
                                                //Show Chart in card
                                            },
                                            dbblick: function(e) {
                                                map.fitBounds(e.target.getBounds())
                                            }
                                        })
                                    },
                                    style: {
                                        fillColor: '{{ $bkk->style }}',
                                        weight: 2,
                                        opacity: 1,
                                        color: '{{ $bkk->style }}',
                                        dashArray: '3',
                                        fillOpacity: 0.7
                                    }
                                })
                        },
                    @endforeach
                ]
            },
            {
                group: "Jenis Tanah",
                collapsed: true,
                layers: [
                    @foreach ($jenis_tanah as $bkk)
                        {
                            active: false,
                            name: '{{ $bkk->nama_jenis_tanah }}',
                            layer: new L.GeoJSON.AJAX(
                                "{{ asset('uploads/geojson/' . $bkk->geojson_file) }}", {
                                    onEachFeature: function(f, l) {
                                        var out = [];
                                        if (f.properties) {
                                            out.push("Jenis Tanah: " + f.properties['JN_TNH']);
                                            l.bindPopup(out.join("<br />"));
                                        }
                                    },
                                    style: {
                                        fillColor: '{{ $bkk->style }}',
                                        weight: 2,
                                        opacity: 1,
                                        color: 'transparent',
                                        dashArray: '3',
                                        fillOpacity: 0.7
                                    }
                                })
                        },
                    @endforeach
                ]
            },
            {
                group: "Morfologi",
                collapsed: true,
                layers: [
                    @foreach ($morfologi as $bkk)
                        {
                            active: false,
                            name: '{{ $bkk->nama_morfologi }}',
                            layer: new L.GeoJSON.AJAX(
                                "{{ asset('uploads/geojson/' . $bkk->geojson_file) }}", {
                                    onEachFeature: function(f, l) {
                                        var out = [];
                                        if (f.properties) {
                                            out.push("Morfologi: " + f.properties['morpologi']);
                                            l.bindPopup(out.join("<br />"));
                                        }
                                    },
                                    style: {
                                        fillColor: '{{ $bkk->style }}',
                                        weight: 2,
                                        opacity: 1,
                                        color: 'transparent',
                                        dashArray: '3',
                                        fillOpacity: 0.7
                                    }
                                })
                        },
                    @endforeach
                ]
            },
            {
                group: "Kelerengan",
                collapsed: true,
                layers: [
                    @foreach ($kelerengan as $bkk)
                        {
                            active: false,
                            name: '{{ $bkk->nama_kelerengan }}',
                            layer: new L.GeoJSON.AJAX(
                                "{{ asset('uploads/geojson/' . $bkk->geojson_file) }}", {
                                    onEachFeature: function(f, l) {
                                        var out = [];
                                        if (f.properties) {
                                            out.push("Kelerengan: " + f.properties['Kelerengan']);
                                            l.bindPopup(out.join("<br />"));
                                        }
                                    },
                                    style: {
                                        fillColor: '{{ $bkk->style }}',
                                        weight: 2,
                                        opacity: 1,
                                        color: 'transparent',
                                        dashArray: '3',
                                        fillOpacity: 0.7
                                    }
                                })
                        },
                    @endforeach
                ]
            },
            {
                group: "Kawasan Pemukiman",
                collapsed: true,
                layers: [
                    @foreach ($kawasan_pemukiman as $bkk)
                        {
                            active: false,
                            name: '{{ $bkk->nama_kawasan_pemukiman }}',
                            layer: new L.GeoJSON.AJAX(
                                "{{ asset('uploads/geojson/' . $bkk->geojson_file) }}", {
                                    onEachFeature: function(f, l) {
                                        var out = [];
                                        if (f.properties) {

                                            out.push("Catatan: " + f.properties['NAMOBJ_1']);
                                            l.bindPopup(out.join("<br />"));
                                        }
                                    },
                                    style: {
                                        fillColor: '{{ $bkk->style }}',
                                        weight: 2,
                                        opacity: 1,
                                        color: 'white',
                                        dashArray: '3',
                                        fillOpacity: 0.7
                                    }
                                })
                        },
                    @endforeach
                ]
            },
            {
                group: "Data Banjir",
                collapsed: true,
                layers: [
                    @foreach ($data_banjir as $bkk)
                        {
                            active: false,
                            name: '{{ $bkk->nama_data }}',
                            layer: new L.GeoJSON.AJAX(
                                "{{ asset('uploads/geojson/' . $bkk->geojson_file) }}", {
                                    onEachFeature: function(f, l) {
                                        var out = [];
                                        if (f.properties) {
                                            @php
                                                $ray = explode(',', $bkk->properties_show);
                                                foreach ($ray as $d) {
                                                    if ($d != null) {
                                                        echo "out.push('" . $d . " : ' + f.properties['" . $d . "']);";
                                                    }
                                                }
                                            @endphp
                                            l.bindPopup(out.join("<br />"));
                                        }

                                    },
                                    style: function(feature) {
                                        @php
                                            $ray = explode(',', $bkk->properties_show);
                                            foreach ($ray as $d) {
                                                if (str_contains($d, 'Kelas')) {
                                                    echo "let vars = feature.properties['" . $d . "'];";
                                                }
                                            }
                                        @endphp
                                        switch (vars) {
                                            case 'Rendah':
                                                color = 'green';
                                                break;
                                            case 'Sedang':
                                                color = 'yellow';
                                                break;
                                            case 'Tinggi':
                                                color = 'red';
                                                break;
                                        }
                                        return {
                                            fillColor: [color],
                                            weight: 2,
                                            opacity: 1,
                                            color: 'white',
                                            dashArray: '3',
                                            fillOpacity: 0.7
                                        }

                                    }
                                })
                        },
                    @endforeach
                ]
            },
            {
                group: "Infrastruktur",
                collapsed: true,
                layers: [
                    @foreach ($infrastruktur as $bkk)
                        {
                            active: false,
                            name: '{{ $bkk->nama_infrastruktur }}',
                            layer: new L.GeoJSON.AJAX(
                                "{{ asset('uploads/geojson/' . $bkk->geojson_file) }}", {
                                    onEachFeature: function(f, l) {
                                        var out = [];
                                        if (f.properties) {
                                            @php
                                                $ray = explode(',', $bkk->properties_show);
                                                foreach ($ray as $d) {
                                                    if ($d != null) {
                                                        echo "out.push('" . $d . " : ' + f.properties['" . $d . "']);";
                                                    }
                                                }
                                            @endphp
                                            l.bindPopup(out.join("<br />"));
                                        }
                                    },
                                    pointToLayer(feature, latlng) {
                                        const IconInfra = L.icon({
                                            iconUrl: "{{ isset($bkk->style) && $bkk->style != '-' ? 'uploads/' . $bkk->style : 'assets/img/lokasi.png' }}",
                                            iconSize: [32, 37],
                                            iconAnchor: [16, 37],
                                            popupAnchor: [0, -28]
                                        });
                                        return L.marker(latlng, {
                                            icon: IconInfra
                                        });
                                    },

                                })
                        },
                    @endforeach
                ]
            },

        ];
        var pl = new L.Control.PanelLayers(baseLayers, overlays, {
            position: 'topright',
            collapsibleGroups: true,
            selectorGroup: true
        });

        map.addControl(pl);

        function closePanel(val) {
            $('#' + val.id).remove()
        }

        //Adding
        var raykec = [
            @foreach ($batas_kec_desa as $bkk)
                {
                    id: {{ $bkk->id }},
                    name: '{{ $bkk->WADMKC }}',
                    color: '{{ $bkk->style }}'
                },
            @endforeach

        ];
        var s =
            '<div id="kecLegend" class="mt-2 bg-white p-2 rounded-lg shadow-lg w-40 max-h-60 overflow-y-auto"> <div class="grid grid-cols-2"> <p>Kecamatan Desa</p> <button type="button" onClick="closePanel(kecLegend)" class="text-end">X</button> </div><br> <table id="table_kec">';
        raykec.map((item, index) => {
            s += ' <tr id="datakec_' + item.id + '"> <td> <div  style="background-color:' + item.color +
                '; width: 25px;height:25px;"></div> </td> <td> ' + item.name + '</td> </tr>';
        })

        s += '</table>  </div>';
        $('#legendContainer').append(s)

        map.on('overlayadd', function(e) {
            let name = e.name;
            var rayBanjir = [
                @foreach ($data_banjir as $bkk)
                    '{{ $bkk->nama_data }}',
                @endforeach
            ];
            var raykec = [
                @foreach ($batas_kec_desa as $bkk)
                    {
                        id: {{ $bkk->id }},
                        name: '{{ $bkk->WADMKC }}',
                        color: '{{ $bkk->style }}'
                    },
                @endforeach

            ]
            if (rayBanjir.includes(name)) {
                if ($('#legendContainer').children('#banjirLegend').length <= 0) {
                    $('#legendContainer').append(
                        '<div id="banjirLegend" class="mt-2 bg-white p-2 rounded-lg shadow-lg w-40 max-h-80 overflow-y-auto"> <div class="grid grid-cols-2"> <p>Kelas Resiko</p>  <button type="button" onClick="closePanel(banjirLegend)" class="text-end">X</button> </div> <br> <table> <tr> <td> <div class="bg-red-500" style="width: 25px;height:25px;"></div> </td> <td> Tinggi</td> </tr> <tr> <td> <div class="bg-yellow-300" style="width: 25px;height:25px;"></div> </td> <td> Sedang</td> </tr> <tr> <td> <div class="bg-green-500" style="width: 25px;height:25px;"></div> </td> <td> Rendah</td> </tr> </table>  </div>'
                    )
                }
            }
            let raykec_filter = raykec.filter(ryc => ryc.name.includes(name));
            if (raykec_filter.length > 0) {
                if ($('#legendContainer').children('#kecLegend').length <= 0) {
                    $('#legendContainer').append(
                        '<div id="kecLegend" class="mt-2 bg-white p-2 rounded-lg shadow-lg w-40 max-h-80 overflow-y-auto"> <div class="grid grid-cols-2"> <p>Kecamatan Desa</p>  <button type="button" onClick="closePanel(kecLegend)" class="text-end">X</button></div> <br> <table id="table_kec"> <tr id="datakec_' +
                        raykec_filter[0].id + '"> <td> <div  style="background-color:' + raykec_filter[0]
                        .color + '; width: 25px;height:25px;"></div> </td> <td> ' + raykec_filter[0].name +
                        '</td> </tr></table> </div>')
                } else if ($('#legendContainer').children('#kecLegend').length > 0) {
                    $('#table_kec').append('<tr id="datakec_' + raykec_filter[0].id +
                        '"> <td> <div  style="background-color:' + raykec_filter[0].color +
                        '; width: 25px;height:25px;"></div> </td> <td> ' + raykec_filter[0].name +
                        '</td> </tr>'
                    )

                }

            }

        });
        map.on('overlayremove', function(e) {
            let name = e.name;
            var raykec = [
                @foreach ($batas_kec_desa as $bkk)
                    {
                        id: {{ $bkk->id }},
                        name: '{{ $bkk->WADMKC }}',
                        color: '{{ $bkk->style }}'
                    },
                @endforeach

            ]
            let raykec_filter = raykec.filter(ryc => ryc.name.includes(name));
            var rayBanjir = [
                @foreach ($data_banjir as $bkk)
                    '{{ $bkk->nama_data }}',
                @endforeach
            ];
            if (rayBanjir.includes(name)) {
                $('#banjirLegend').remove()
            }
            if (raykec_filter.length > 0) {
                $('#datakec_' + raykec_filter[0].id).remove()
            }

        })
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

                marker.on('click', function(e) {
                    $('#legendContainer').append(
                        '<div id="laporanLegend" class="mt-2 bg-white p-2 rounded-lg shadow-lg w-50 max-h-80 overflow-y-auto"> <div class="grid grid-cols-2"> <p>Titik Bencana</p>  <button type="button" onClick="closePanel(laporanLegend)" class="text-end">X</button></div> <br> <p>{{ chr(65 + $index) }} {{ $report->jenis_bencana }}</p> </div>'
                    )
                })

                //  marker.bindPopup(`<b>${priority}</b><br>{{ $report->lokasi }}<br>{{ $report->jenis_bencana }}`);

                @php $index++; @endphp
            @endforeach
        @endforeach
    </script>
    <script>
        $('.container-resiko').html('<div class="bg-gray-500 w-full p-2"></div><p class="text-center">Belum Ada Data</p>');
        var pbbChart;
        var pptChart;
        var pkfChart;
        var kktbbChart;
        var rbpkChart;

        function setpbbChart(data = []) {
            if (pbbChart) {
                pbbChart.destroy();
            }
            pbbChart = setChart('pbb', data)
        }

        function setpptChart(data = []) {
            if (pptChart) {
                pptChart.destroy();
            }
            pptChart = setChart('ppt', data)
        }

        function setpkfChart(data = []) {
            if (pkfChart) {
                pkfChart.destroy();
            }
            pkfChart = setChart('pkf', data)
        }

        function setrbpkChart(data = []) {
            if (rbpkChart) {
                rbpkChart.destroy();
            }
            rbpkChart = setChart('rbpk', data)
        }

        function setkktbbChart(data = []) {
            if (kktbbChart) {
                kktbbChart.destroy();
            }
            kktbbChart = setChart('kktbb', data)
        }

        function setChart(id = 'frekuensi_kejadian', areaChartData = {}) {
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

        //Tabulasi Bahaya Banjir
        var lb_rendah = 0;
        var lb_sedang = 0;
        var lb_tinggi = 0;

        //Penduduk Terpapar
        var penduduk_terpapar = 0;
        var kelompok_umur_rentan = 0;
        var penduduk_disabilitas = 0;
        var penduduk_miskin = 0;

        //Kerugian Fisik
        var kerugian_fisik = 0;
        var kerugian_ekonomi = 0;
        var potensi_kerusakan_linkungan = 0;

        //Tabulasi Resiko Banjir
        var lbr_rendah = 0;
        var lbr_sedang = 0;
        var lbr_tinggi = 0;

        //Index Ketahanan
        var index_ketahanan_daerah = 0;
        var index_kesiapsiagaan = 0;
        var index_kapasitas = 0;

        @foreach ($batas_kec_desa as $bkk)
            lb_rendah +=
                {{ isset($bkk->TabulasiBahayaBanjir->lb_rendah) ? $bkk->TabulasiBahayaBanjir->lb_rendah : 0 }};
            lb_sedang +=
                {{ isset($bkk->TabulasiBahayaBanjir->lb_sedang) ? $bkk->TabulasiBahayaBanjir->lb_sedang : 0 }};
            lb_tinggi +=
                {{ isset($bkk->TabulasiBahayaBanjir->lb_tinggi) ? $bkk->TabulasiBahayaBanjir->lb_tinggi : 0 }};

            penduduk_terpapar +=
                {{ isset($bkk->PotensiPendudukTerpapar->penduduk_terpapar) ? $bkk->PotensiPendudukTerpapar->penduduk_terpapar : 0 }};
            kelompok_umur_rentan +=
                {{ isset($bkk->PotensiPendudukTerpapar->kelompok_umur_rentan) ? $bkk->PotensiPendudukTerpapar->kelompok_umur_rentan : 0 }};
            penduduk_disabilitas +=
                {{ isset($bkk->PotensiPendudukTerpapar->penduduk_disabilitas) ? $bkk->PotensiPendudukTerpapar->penduduk_disabilitas : 0 }};
            penduduk_miskin +=
                {{ isset($bkk->PotensiPendudukTerpapar->penduduk_miskin) ? $bkk->PotensiPendudukTerpapar->penduduk_miskin : 0 }};
            kerugian_fisik +=
                {{ isset($bkk->PotensiKerugian->kerugian_fisik) ? $bkk->PotensiKerugian->kerugian_fisik : 0 }};
            kerugian_ekonomi +=
                {{ isset($bkk->PotensiKerugian->kerugian_ekonomi) ? $bkk->PotensiKerugian->kerugian_ekonomi : 0 }};
            potensi_kerusakan_linkungan +=
                {{ isset($bkk->PotensiKerugian->potensi_kerusakan_lingkungan) ? $bkk->PotensiKerugian->potensi_kerusakan_lingkungan : 0 }};
            lbr_rendah += {{ isset($bkk->TabulasiResikoBanjir->lb_rendah) ? $bkk->TabulasiResikoBanjir->lb_rendah : 0 }};
            lbr_sedang += {{ isset($bkk->TabulasiResikoBanjir->lb_sedang) ? $bkk->TabulasiResikoBanjir->lb_sedang : 0 }};
            lbr_tinggi += {{ isset($bkk->TabulasiResikoBanjir->lb_tinggi) ? $bkk->TabulasiResikoBanjir->lb_tinggi : 0 }};
            index_ketahanan_daerah +=
                {{ isset($bkk->KapasitasBanjir->index_ketahanan_daerah) ? $bkk->KapasitasBanjir->index_ketahanan_daerah : 0 }};
            index_kesiapsiagaan +=
                {{ isset($bkk->KapasitasBanjir->index_kesiapsiagaan) ? $bkk->KapasitasBanjir->index_kesiapsiagaan : 0 }};
            index_kapasitas +=
                {{ isset($bkk->KapasitasBanjir->index_kapasitas) ? $bkk->KapasitasBanjir->index_kapasitas : 0 }}
        @endforeach

        var pbbData = {
            labels: ['Rendah', 'Sedang', 'Tinggi'],
            datasets: [{
                label: 'Luas Bahaya (ha)',
                backgroundColor: ['green',
                    'yellow', 'red'
                ],
                borderColor: 'rgba(60,141,188,0.8)',
                data: [lb_rendah, lb_sedang, lb_tinggi]
            }]
        }
        setpbbChart(pbbData)

        var pptData = {
            labels: ['Penduduk Terpapar',
                'Kelompok Umur Rentan',
                'Penduduk Disabilitas',
                'Penduduk Miskin'
            ],
            datasets: [{
                label: 'Penduduk Terpapar',
                backgroundColor: 'blue',
                borderColor: 'rgba(60,141,188,0.8)',
                data: [penduduk_terpapar, kelompok_umur_rentan, penduduk_disabilitas, penduduk_miskin]
            }]
        }
        setpptChart(pptData)

        var pkfdata = {
            labels: ['Kerugian Fisik',
                'Kerugian Ekonomi',
                'Potensi Kerusakan Lingkungan'
            ],
            datasets: [{
                label: 'Potensi Kerugian Fisik,Ekonomi dan Kerusakan Lingkungan',
                backgroundColor: 'blue',
                borderColor: 'rgba(60,141,188,0.8)',
                data: [kerugian_fisik, kerugian_ekonomi, potensi_kerusakan_linkungan]
            }]
        }
        setpkfChart(pkfdata)

        var rbpkData = {
            labels: ['Rendah', 'Sedang', 'Tinggi'],
            datasets: [{
                label: 'Rendah',
                backgroundColor: ['green',
                    'yellow', 'red'
                ],
                borderColor: 'rgba(60,141,188,0.8)',
                data: [lbr_rendah, lbr_sedang, lbr_tinggi]
            }]
        }
        setrbpkChart(rbpkData)

        var kktbbData = {
            labels: ['Index Ketahanan',
                'Index Kesiapsiagaan',
                'Index Kapasitas'
            ],
            datasets: [{
                label: 'Index Ketahanan',
                backgroundColor: 'blue',
                borderColor: 'rgba(60,141,188,0.8)',
                data: [index_ketahanan_daerah, index_kesiapsiagaan, index_kapasitas]
            }]
        }
        setkktbbChart(kktbbData)
        $('.container-resiko').html(
            '<div class="bg-red-500 w-full p-2"></div><p class="text-center">Tinggi</p>'
        );
    </script>
@endsection
