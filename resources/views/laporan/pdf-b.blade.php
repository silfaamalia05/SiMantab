<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bencana</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            margin: auto;
            text-align: center;
        }

        th,
        td {
            text-align: left;
            font-weight: normal;
            vertical-align: top;
        }

        td {
            vertical-align: top;
            padding: 0 50px;
        }

        .grid>.block {
            text-align: center;
        }


        table {
            margin: auto;
            text-align: left;
        }


        .header {
            text-align: center;
        }

        .block {
            display: block;
            text-align: left !important;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            column-gap: 1em;
        }

        .numbered {
            position: relative;
            padding-left: 25px;
        }

        .numbered::before {
            content: attr(data-number);
            position: absolute;
            left: 0;
            top: 0;
            width: 20px;
            text-align: right;
        }

        .double-dot {
            position: relative;
            padding-left: 25px;
        }

        .double-dot::before {
            content: attr(data-number);
            position: absolute;
            left: 0;
            top: 0;
            width: 20px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="grid">
            <div class="block">
                <p>Kepada Yth,<br>POSKO PB PU<br>Dirjen .....<br>Di<br><u>Jakarta</u></p>
            </div>

            <div style="position:absolute;right:0;top:0;margin-top:10px;">
                <div style="width: 100%;border: 1px solid black; padding: 8px; text-align: center">
                    DIKIRIM SETELAH<br>DIPEROLEH DATA<br>DETAIL BENCANA
                </div>
            </div>
        </div>
        <h3 class="header">LAPORAN BENCANA</h3>

        <p style="text-align:left; margin:0">1. BENCANA</p>
        <table style="padding-left: 10px;">
            <tr>
                <th class="numbered" data-number="a.">Kejadian</th>
                <td></td>
            </tr>
            <tr>
                <th style="padding-left:25px">1). Jenis Bencana </th>
                <td class="double-dot" data-number=":">{{ $report->jenis_bencana }}</td>
            </tr>
            <tr>
                <th style="padding-left:25px">2). Waktu Kejadian</th>
                <td class="double-dot" data-number=":">
                    Hari {{ \Carbon\Carbon::parse($report->waktu_kejadian)->translatedFormat('l') }},
                    Tanggal {{ \Carbon\Carbon::parse($report->waktu_kejadian)->translatedFormat('j-m-Y') }},
                    Jam {{ \Carbon\Carbon::parse($report->waktu_kejadian)->translatedFormat('H:i') }}
                </td>
            </tr>
            <tr>
                <th style="padding-left:25px">3). Tempat Kejadian</th>
                <td class="double-dot" data-number=":">{{ $report->lokasi }}</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <th class="numbered" data-number="b." colspan="2">Perkiraan dampak bencana</th>
            </tr>
            <tr>
                <th style="padding-left:25px">1). Korban</th>
                <td class="double-dot" data-number=":">{{ $report->meninggal }} meninggal, {{ $report->luka_berat }}
                    luka berat, {{ $report->luka_ringan
                    }} luka ringan, {{ $report->hilang }} hilang</td>
            </tr>
            <tr>
                <th style="padding-left:25px">2). Mengungsi</th>
                <td class="double-dot" data-number=":">{{ $report->mengungsi }} jiwa</td>
            </tr>
            <tr>
                <th style="padding-left:25px">3). Kerusakan</th>
                <td class="double-dot" data-number=":">{{ $report->rumah }} rumah, {{ $report->kantor }} kantor,
                    {{ $report->fasum_faskes }}
                    fasum/faskes, {{ $report->jalan_jembatan }} jalan/jembatan, {{ $report->sawah_lahan_pertanian }}
                    sawah/lahan pertanian, {{ $report->sarpras }} sarana prasarana SDA
                </td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:justify" class="numbered" data-number="c.">
                    Upaya penanganan yang telah dilakukan oleh BPBD Provinsi/Satuan Kerja Penanggulangan Bencana/BPBD
                    Kabupaten/Kota, Posko Pelaksanaan Tanggap Darurat Pekerjaan Umum : <br>
                    {{ $report->p_darurat }}
                </td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:justify" class="numbered" data-number="d.">
                    Sumberdaya yang tersedia di lokasi bencana<br>
                    {{ $report->sda }}
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:justify" class="numbered" data-number=" ">
                    Kendala / hambatan<br>
                    {{ $report->kendala }}
                </td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:justify" class="numbered" data-number="e.">
                    Kebutuhan mendesak : <br>
                    {{ $report->kebutuhan }}
                </td>
            </tr>
        </table>

        <br><br>
        <div class="grid">
            <div style="position:absolute;right:0;text-align:left">
                <p>Banjar, {{ \Carbon\Carbon::parse($report->created_at)->translatedFormat('j F Y') }}</p>
                <p>KEPALA BALAI BESAR/BALAI/<br>
                    SATKER .......,
                    <br><br><br><br>
                    Nama : ..........................
                    <br>
                    NIP : ..........................
                </p>
            </div>
        </div>
        <div style="position:absolute;left:0;bottom:0;text-align:left">
            <p>Tembusan</p>
            <p>Sekretariat Satgas PBPU</p>
        </div>
    </div>
    <div style="page-break-after: always;"></div>
    <div class="container">
        <h5 style="text-align: left;">Lampiran (Dokumentasi)</h5>
        <div style="grid-template-columns: repeat(2, 1fr); grid-template-rows: repeat(2, 1fr); gap: 10px;">
            @foreach($images as $index => $image)
                        @php
                            $imagePath = storage_path('app/public/' . $image->image_path);
                            $imageData = base64_encode(file_get_contents($imagePath));
                            $src = 'data:image/png;base64,' . $imageData;
                        @endphp
                        <img src="{{ $src }}" alt="Image {{ $index + 1 }}" style="max-width:3.2in; margin-top: 50px;">
            @endforeach
        </div>
    </div>
</body>

</html>