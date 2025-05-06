<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bencana</title>
</head>

<body>
    <style type="text/css">
        .tg {
            border-collapse: collapse;
            width: 100%;
            border: 2px solid black;
        }

        .tg td,
        .tg th {
            border: 1px solid black;
            font-family: Arial, sans-serif;
            font-size: 12px;
            padding: 8px;
            text-align: center;
            vertical-align: middle;
            word-wrap: break-word;
            white-space: normal;
            overflow-wrap: break-word;
        }

        .tg th {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        thead {
            display: table-row-group;
        }
    </style>

    <div>
        <div class="grid">
            <div class="block">
                <p>Kepada Yth,<br>POSKO PB PU<br>Dirjen .....<br>Di<br><u>Jakarta</u></p>
            </div>

            <div style="position:absolute;right:0;top:0;margin-top:20px;margin-right:100px;">
                <div style="width: 100%;border: 1px solid black; padding: 8px; text-align: center">
                    DIKIRIM SETELAH<br>DIPEROLEH DATA<br>DETAIL BENCANA
                </div>
            </div>
        </div>
        <h3 class="header" style="text-align: center;">Skala Prioritas Penanggulangan Darurat Kerusakan dan/atau Bencana
            Akibat Daya Rusak Air</h3>

        <table class="tg" style="table-layout: fixed; width: 1037px;">
            <colgroup>
                <col style="width: 32.333332999999996px">
                <col style="width: 93.333333px">
                <col style="width: 59.333333px">
                <col style="width: 97.333333px">
                <col style="width: 114.333333px">
                <col style="width: 95.333333px">
                <col style="width: 117.333333px">
                <col style="width: 109.333333px">
                <col style="width: 145.333333px">
                <col style="width: 89.333333px">
                <col style="width: 61.333333px">
                <col style="width: 22.333333px">
            </colgroup>
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Nama/Jenis<br>Prasarana<br>SDA</th>
                    <th colspan="2">Lokasi</th>
                    <th colspan="4">Kondisi prasarana dan sarana SDA</th>
                    <th rowspan="2">Rencana Aksi<br>Penanggulangan</th>
                    <th rowspan="2">Skala<br>Prioritas</th>
                    <th rowspan="2" colspan="2">Ket</th>
                </tr>
                <tr>
                    <th>Nama Sungai</th>
                    <th>Nama Desa/<br>Kecamatan</th>
                    <th>Tingkat<br>Kerusakan</th>
                    <th>Penyebab<br>Kerusakan</th>
                    <th>Fungsi<br>Layanan</th>
                    <th>Ancaman <br>Dampak</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report as $key => $data)
                    <tr>
                        <td class="tg-0lax">{{ $key + 1 }}</td>
                        <td class="tg-0pky">{{ $data->sarpras }}</td>
                        <td class="tg-0pky">{{ $data->sungai }}</td>
                        <td class="tg-0pky">{{ $data->lokasi }}</td>
                        <td class="tg-0pky">{{ $data->tingkat_kerusakan }}</td>
                        <td class="tg-0pky">{{ $data->jenis_bencana }}</td>
                        <td class="tg-0lax">
                            @if ($data->fungsi_layanan == 'TBSS')
                                Tidak berfungsi sama sekali
                            @elseif ($data->fungsi_layanan == 'BDP')
                                Dapat berfungsi dengan perbaikan
                            @elseif ($data->fungsi_layanan == 'BDPR')
                                Masih berfungsi dengan perbaikan ringan
                            @endif
                        </td>
                        <td class="tg-0lax">{{ $data->ancaman }}</td>
                        <td class="tg-0lax">{{ $data->rencana_aksi }}</td>
                        <td class="tg-0lax">{{ $data->skala_prioritas >= 2.5 ? '1' : '2' }}</td>
                        <td class="tg-0lax" colspan="2"></td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="6" style="height: 200px; vertical-align: top;">Rincian Anggaran Biaya</td>
                    <td colspan="6" style="height: 200px; vertical-align: top;">Gambar/Sket</td>
                </tr>
                <tr>
                    <td style="text-align:left !important; vertical-align: top !important; height: 50px;" colspan="12">
                        Catatan :</td>
                </tr>
                <tr>
                    <td colspan="6">Dibuat Oleh: Tim Kaji Cepat BBWS/BWS ......</td>
                    <td colspan="6">Tim Verifikasi Direktorat Jenderal Sumber Daya Air</td>
                </tr>
                <tr>
                    <td colspan="2">Nama</td>
                    <td colspan="2">Jabatan</td>
                    <td colspan="2">Tanda Tangan</td>
                    <td colspan="2">Nama</td>
                    <td colspan="2">Jabatan</td>
                    <td colspan="2">Tanda Tangan</td>
                </tr>
                <tr>
                    <td colspan="2" style="height:100px"></td>
                    <td colspan="2" style="height:100px"></td>
                    <td colspan="2" style="height:100px"></td>
                    <td colspan="2" style="height:100px"></td>
                    <td colspan="2" style="height:100px"></td>
                    <td colspan="2" style="height:100px"></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>