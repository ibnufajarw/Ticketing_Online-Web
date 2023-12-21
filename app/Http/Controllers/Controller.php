<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function snapToken($transaksi)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.IS_PRODUCTION');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $transaksi->id,
                'gross_amount' => $transaksi->total_pembayaran,
            ),

            "item_details" => [
                [
                    "id" => "1",
                    "price" => $transaksi->total_pembayaran,
                    "quantity" => 1,
                    "name" => $transaksi->acara->judul . ' | ' . $transaksi->tiket->kode . '-' . $transaksi->tiket->tier
                ],
            ],
            'customer_details' => array(
                'first_name' => $transaksi->user->nama,
                'last_name' => $transaksi->user->nama,
                'email' => $transaksi->user->email,
            ),
            "callbacks" => [
              "finish" => route('transaksi.detail', $transaksi->kode_transaksi)
            ]
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return $snapToken;
    }
}
