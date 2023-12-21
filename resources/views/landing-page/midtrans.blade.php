@extends('template.landing-page.app')

@section('title', 'Pembayaran')

@section('content')
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="{{ config('midtrans.MIDTRANS_URL') }}"
        data-client-key="{{ config('midtrans.MIDTRANS_CLIENT_KEY') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <div class="container py-5">
        <div class="row" style="margin-top: 50px;">

            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-12 text-center">
                        <div class="d-flex justify-content-center mb-2">
                            <h4>{!! $transaksi->acara->judul !!}</h4>
                        </div>
                        <p class="fs-14 text-muted">{{ $transaksi->acara->alamat }}</p>
                        <p class="fs-14 text-muted"><i class="fa-regular fa-calendar me-1"></i>
                            {{ $transaksi->acara->waktu_mulai->translatedFormat('d M Y H:i') }}
                            -
                            {{ $transaksi->acara->waktu_selesai->translatedFormat('d M Y H:i') }}
                        </p>
                        <label for="">Total Biaya Pendaftaran :</label>
                        <b>{{ number_format($transaksi->total_pembayaran, 2, ',', '.') }}</b>
                        <hr>
                        <center>
                            <button type="submit" class="btn btn-primary" id="pay-button">Bayar</button>
                        </center>
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
