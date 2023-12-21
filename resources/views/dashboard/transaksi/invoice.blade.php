<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
</head>
<style>
    .gor-image {
        height: 100px;
        width: 160px;
        float: left;
        margin-left: -80px;
        margin-right: 30px;
    }

    .container {
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }

    body {
        font-family: 'Roboto Condensed', sans-serif;
    }

    .m-0 {
        margin: 0px;
    }

    .p-0 {
        padding: 0px;
    }

    .pt-5 {
        padding-top: 5px;
    }

    .mt-10 {
        margin-top: 10px;
    }

    .text-center {
        text-align: center !important;
    }

    .w-100 {
        width: 100%;
    }

    .w-50 {
        width: 50%;
    }

    .w-85 {
        width: 85%;
    }

    .w-15 {
        width: 15%;
    }

    .logo img {
        width: 45px;
        height: 45px;
        padding-top: 30px;
    }

    .logo span {
        margin-left: 8px;
        top: 19px;
        position: absolute;
        font-weight: bold;
        font-size: 25px;
    }

    .gray-color {
        color: #5D5D5D;
    }

    .text-bold {
        font-weight: bold;
    }

    .border {
        border: 1px solid black;
    }

    table tr,
    th,
    td {
        border: 1px solid #d2d2d2;
        border-collapse: collapse;
        padding: 7px 8px;
    }

    table tr th {
        background: #F4F4F4;
        font-size: 15px;
    }

    table tr td {
        font-size: 13px;
    }

    table {
        border-collapse: collapse;
    }

    .box-text p {
        line-height: 10px;
    }

    .float-left {
        float: left;
    }

    .total-part {
        font-size: 16px;
        line-height: 12px;
    }

    .total-right p {
        padding-right: 20px;
    }
</style>

<body>

    <title>Invoice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <div class="container">
        <center>
            <h6> {{ $transaksi->acara->judul }} </span>
        </center>
        </h6>
        <p style="line-height:1.5;text-align:center">
            <small>{{ $transaksi->acara->alamat }}
            </small>
        </p>
    </div>
    <hr style="height:4px;color:black;background:black">

    <div class="add-detail mt-10">
        <div class="w-50 float-left mt-10">
            <p class="m-0 text-bold w-100">Kode Transaksi - <span
                    class="gray-color">{{ $transaksi->kode_transaksi }}</span></p>
            <p class="m-0 text-bold w-100">Waktu Pembelian - <span
                    class="gray-color">{{ date('Y-m-d H:i:s ', strtotime($transaksi->created_at)) }}</span></p>
        </div>
        <div style="clear: both;"></div>
    </div>
    <main>
        <div class="table-section bill-tbl w-100 mt-10">
            <table class="table w-100 mt-10">
                <tr style="text-align:center;">
                    <th class="w-50">Nama Acara</th>
                    <th class="w-50">Waktu Acara</th>
                    <th class="w-50">Nama Pembeli</th>
                    <th class="w-50">Metode Pembayaran</th>
                    <th class="w-50">Status Pembayaran</th>
                </tr>
                <tr style="text-align:center;">
                    <td>
                        {{ $transaksi->acara->judul }}
                    </td>
                    <td>{{ $transaksi->acara->waktu_mulai->translatedFormat('d M Y H:i') }}</td>
                    <td>{{ $transaksi->user->nama }}</td>
                    <td>
                        @if ($transaksi->bukti_transfer)
                            Manual
                        @else
                            Midtrans
                        @endif
                    </td>
                    <td>LUNAS/DIBAYAR</td>
                </tr>
            </table>
        </div>
        <div class="table-section bill-tbl w-100 mt-10">
            <table class="table w-100 mt-10">
                <tr style="text-align:center;">
                    <th class="w-50">Detail Tiket</th>
                    <th class="w-50">Kursi</th>
                    <th class="w-50">Harga</th>
                </tr>
                <tr style="text-align:center;">
                    <td style="text-align:center;" class="service">
                        {{ $transaksi->tiket->kode }}-{{ $transaksi->tiket->tier }}</td>
                    <td style="text-align:center;" class="service">
                        {{ $transaksi->tiket->kursi }}</td>
                    <td style="text-align:center;" class="desc">
                        {{ $transaksi->harga > 0 ? number_format($transaksi->harga, 0, ',', '.') : 'Gratis' }}
                    </td>
                </tr>
            </table>
        </div>
    </main>
</body>

</html>
