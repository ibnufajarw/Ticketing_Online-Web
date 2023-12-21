@extends('template.dashboard.app')

@section('title', 'Transaksi')

@push('styles')
    <link href="{{ asset('dashboard-assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.midtrans_client_id') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <h1 class="h3 mb-4 text-gray-800">Transaksi</h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>

                                <tr>
                                    <th>Dibuat Pada</th>
                                    <th>:</th>
                                    <th>{{ $transaksi->created_at }}</th>
                                </tr>
                                <tr>
                                    <th>Acara</th>
                                    <th>:</th>
                                    <th>{{ $transaksi->acara->judul }}</th>
                                </tr>
                                <tr>
                                    <th>Tiket</th>
                                    <th>:</th>
                                    <th>{{ $transaksi->tiket->kode }}-{{ $transaksi->tiket->tier }} | Kursi :
                                        {{ $transaksi->tiket->kursi }}</th>
                                </tr>
                                <tr>
                                    <th>Harga</th>
                                    <th>:</th>
                                    <th>{{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}</th>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <th>:</th>
                                    <th>

                                        @if ($transaksi->status == 'MENUNGGU')
                                            <span class="badge badge-warning">Menunggu</span>
                                        @elseif ($transaksi->status == 'DIBAYAR')
                                            <span class="badge badge-success">Dibayar</span>
                                        @elseif ($transaksi->status == 'KADALUARSA')
                                            <span class="badge badge-danger">Kadaluarsa</span>
                                        @elseif ($transaksi->status == 'GAGAL')
                                            <span class="badge badge-danger">Gagal</span>
                                        @endif
                                    </th>
                                </tr>
                                <tr>
                                    <th>Metode Pembayaran</th>
                                    <th>:</th>
                                    <th>
                                        @if ($transaksi->bukti_transfer)
                                            Manual | <a target="_blank"
                                                href="{{ Storage::disk('local')->url($transaksi->bukti_transfer) }}">Lihat
                                                Bukti Transfer</a>
                                        @else
                                            Midtrans
                                        @endif
                                    </th>
                                </tr>
                                <tr>
                                    <th>Download Invoice</th>
                                    <th>:</th>
                                    <th>
                                        @if ($transaksi->status == 'DIBAYAR')
                                            <a target="_blank"
                                                href="{{ Storage::disk('local')->url($transaksi->url_invoice) }}"
                                                class="btn btn-success"><i class="fas fa-download"></i> Download Invoice</a>
                                        @elseif($transaksi->status == 'MENUNGGU')
                                            <span class="badge badge-danger">Belum Lunas</span>
                                            <a href="#" id="pay-button" class="btn btn-primary btn-sm">
                                                Bayar Sekarang
                                            </a>
                                        @else
                                            <span class="badge badge-danger">Kadaluarsa</span>
                                        @endif
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    window.location.href =
                        '/dashboard/{{ $transaksi->kode_transaksi }}/detail-transaksi';
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });
    </script>
@endpush
