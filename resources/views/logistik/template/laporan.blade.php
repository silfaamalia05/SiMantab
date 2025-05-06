<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        .table-border {
            width: 100%;
            border: 1px solid black;
           
            border-collapse: collapse;
            text-align: center;
            margin-top: 5px;
        }

        .table-border thead {
            background-color: rgb(227, 235, 219);
            font-size: 8pt;
            border: 1px solid black;
        }

        .table-border tr td {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <center>
        <h4>FORM INVENTARISASI ALAT BERAT</h4>
    </center>
    <table style="width: 100%; border: 0; font-size: 8pt; font-weight: bold;">
        <tr>
            <td width="20%">Nama Balai</td>
            <td>:</td>
        </tr>
        <tr>
            <td width="20%">Status Update</td>
            <td>:</td>
        </tr>
    </table>
    <table class="table-border">
        <thead>
            <tr>
                <td rowspan="2">No</td>
                <td colspan="2">Jenis Alat</td>
                <td rowspan="2">Kapasitas</td>
                <td rowspan="2">Jumlah</td>
                <td colspan="3">Kondisi</td>
                <td rowspan="2">Lokasi</td>
                <td rowspan="2">Koordinat</td>
                <td rowspan="2">Keterangan</td>

            </tr>
            <tr>
                <td>Kategori</td>
                <td>Merk/Model/Type</td>
                <td>Baik</td>
                <td>Rusak Ringan</td>
                <td>Berat</td>
            </tr>
        </thead>
        <tbody style="font-size: 8pt; font-family: 'Arial';">
            @php
                $no = 1;
                $jumlah = 0;
                $baik = 0;
                $rusak_ringan = 0;
                $rusak_berat = 0;
            @endphp
            @foreach ($kategori as $item)
                <tr style="border:2px solid black; padding: 5px; text-align: left; background-color:rgb(242,220,153);">
                    <td colspan="11" style="padding: 10px">{{ $item->name }}</td>
                </tr>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $d)
                    @if ($d->kategori_logistik_id == $item->id)
                        @php
                            $jumlah += $d->jumlah;
                            $baik += $d->kondisi_baik;
                            $rusak_ringan += $d->kondisi_rusak_ringan;
                            $rusak_berat += $d->kondisi_rusak_berat;
                        @endphp
                        <tr style="border:1px solid black; padding: 5px; background-color: white;">
                            <td style=" border: 1px solid black;"></td>
                            <td style="text-align: left;  border: 1px solid black;">
                                {{ $no++ }}.{{ $d->jenis_alat }}</td>
                            <td style="padding: 5px;  border: 1px solid black;">{{ $d->merk }} /
                                {{ $d->model }} / {{ $d->type }}</td>
                            <td style="padding: 5px;  border: 1px solid black;">{{ $d->kapasitas }}</td>
                            <td style="padding: 5px;  border: 1px solid black;">{{ $d->jumlah }}</td>
                            <td style="padding: 5px;  border: 1px solid black;">{{ $d->kondisi_baik }}</td>
                            <td style="padding: 5px;  border: 1px solid black;">{{ $d->kondisi_rusak_ringan }}</td>
                            <td style="padding: 5px;  border: 1px solid black;">{{ $d->kondisi_rusak_berat }}</td>
                            <td style="padding: 5px;  border: 1px solid black;">{{ $d->lokasi }}</td>
                            <td style="padding: 5px;  border: 1px solid black;"></td>
                            <td style="padding: 5px; border: 1px solid black;">{{ $d->keterangan }}</td>

                        </tr>
                    @endif
                @endforeach
            @endforeach
            <tr>
                <td colspan="4" style="text-align: center;">Total</td>
                <td>{{$jumlah}}</td>
                <td>{{$baik}}</td>
                <td>{{$rusak_ringan}}</td>
                <td>{{$rusak_berat}}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

</body>

</html>
