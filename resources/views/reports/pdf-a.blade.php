<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kejadian Bencana</title>
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

        th {
            width: 200px !important;
        }

        td {
            width: 400px !important;
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
                <p>Kepada Yth,<br>POSKO PB PU<br>Di<br><u>Jakarta</u></p>
            </div>

            <div style="position:absolute;right:0;top:0;margin-top:10px;">
                <div style="width: 100%;border: 1px solid black; padding: 8px; text-align: center">
                    DIKIRIM SEGERA <br>SETELAH<br>TERJADI BENCANA
                </div>
            </div>
        </div>
        <h3 class="header">LAPORAN KEJADIAN BENCANA</h3>

        <table>
            <tr>
                <th class="numbered" data-number="1." colspan="2">BENCANA</th>
            </tr>
            <tr>
                <th style="padding-left:25px">a. Jenis Bencana </th>
                <td class="double-dot" data-number=":">{{ $report->jenis_bencana }}</td>
            </tr>
            <tr>
                <th style="padding-left:25px">b. Waktu Kejadian</th>
                <td class="double-dot" data-number=":">{{ \Carbon\Carbon::parse($report->waktu_kejadian)->translatedFormat('l, j F Y') }}</td>
            </tr>
            <tr>
                <th style="padding-left:25px">b. Tempat Kejadian</th>
                <td class="double-dot" data-number=":">{{ $report->lokasi }}</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <th class="numbered" data-number="2." colspan="2">KORBAN / KERUSAKAN YANG TELAH TERJADI</th>
            </tr>
            <tr>
                <th style="padding-left:25px">a. Korban</th>
                <td class="double-dot" data-number=":">{{ $report->meninggal }} meninggal, {{ $report->luka_berat }} luka berat, {{ $report->luka_ringan
                    }} luka ringan, {{ $report->hilang }} hilang</td>
            </tr>
            <tr>
                <th style="padding-left:25px">b. Kerusakan</th>
                <td class="double-dot" data-number=":">{{ $report->rumah }} rumah, {{ $report->kantor }} kantor, {{ $report->{'fasum-faskes'} }}
                    fasum/faskes, {{ $report->{'jalan-jembatan'} }} jalan/jembatan, {{ $report->{'sawah-lahan-pertanian'} }}
                    sawah/lahan pertanian, {{ $report->{'sarana-prasarana'} }} sarana prasarana SDA</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <th class="numbered" data-number="3." colspan="2">BAHAYA BENCANA MASIH MENGANCAM</th>
            </tr>
            <tr>
                <th style="padding-left:25px;">a. Permukiman Penduduk</th>
                <td class="double-dot" data-number=":">{{ $report->pemukiman }}</td>
            </tr>
            <tr>
                <th style="padding-left:25px">b. Perkotaan</th>
                <td class="double-dot" data-number=":">{{ $report->perkotaan }}</td>
            </tr>
            <tr>
                <th style="padding-left:25px">c. Kawasan Industri</th>
                <td class="double-dot" data-number=":">{{ $report->{'kawasan-industri'} }}</td>
            </tr>
            <tr>
                <th style="padding-left:25px">d. Sarana/Prasarana</th>
                <td class="double-dot" data-number=":">{{ $report->sarpras }}</td>
            </tr>
            <tr>
                <th style="padding-left:25px">e. Pertanian</th>
                <td class="double-dot" data-number=":">{{ $report->pertanian }}</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <th class="numbered" data-number="4." colspan="2">PERKIRAAN LAMANYA ANCAMAN BAHAYA : {{ $report->{'lama-ancaman-bahaya'} }}</th>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <th class="numbered" data-number="5." colspan="2">PENANGANAN DARURAT YANG TELAH DILAKUKAN : {{ $report->p_darurat }}</th>
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
</body>

</html>