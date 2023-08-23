<?php

use App\Models\Transaksi;
use Carbon\Carbon;

function cekTiketAvailability($tiket)
{
    $transaksi = Transaksi::where('tiket_id', $tiket->id)->whereIn('status', ['DIBAYAR', 'MENUNGGU'])->count();
    return $transaksi;
}
function getKuota($acara)
{
    $kuota = $acara->kuota - Transaksi::where('acara_id', $acara->id)->whereIn('status', ['DIBAYAR', 'MENUNGGU'])->count();
    return $kuota;
}

function cekTransaksiByTiket($tiket)
{
    $cek = Transaksi::where('tiket_id', $tiket->id)
        ->whereIn('status', ['MENUNGGU', 'DIBAYAR'])
        // ->where('batas_pembayaran', '>=', Carbon::now())
        ->latest()->get()->first();
    return $cek;
}


function cekTransaksi($tiket)
{
    $cek = Transaksi::where('tiket_id', $tiket->id)
        ->where('status', 'DIBAYAR')
        ->orWhere('status', 'MENUNGGU')
        ->orWhere('batas_pembayaran', '>=', Carbon::now())
        ->first();
    return $cek;
}
function updateToKadaluarsa()
{
    Transaksi::where('status', 'MENUNGGU')
        ->where('batas_pembayaran', '<=', Carbon::now())
        ->whereNull('bukti_transfer')
        ->update([
            'status' => 'KADALUARSA'
        ]);
}
