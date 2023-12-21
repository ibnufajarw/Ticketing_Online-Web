<?php

return [
    'MIDTRANS_MERCHANT_ID' => env('MIDTRANS_MERCHANT_ID'),
    'MIDTRANS_CLIENT_KEY' => env('IS_PRODUCTION') ? env('PRODUCTION_MIDTRANS_CLIENT_KEY') : env('SANDBOX_MIDTRANS_CLIENT_KEY'),
    'MIDTRANS_SERVER_KEY' => env('IS_PRODUCTION') ? env('PRODUCTION_MIDTRANS_SERVER_KEY') : env('SANDBOX_MIDTRANS_SERVER_KEY'),
    'IS_PRODUCTION' => env('IS_PRODUCTION'),
    'MIDTRANS_URL' => env('IS_PRODUCTION') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js',
];
