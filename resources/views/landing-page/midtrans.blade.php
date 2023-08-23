@extends('template.landing-page.app')

@section('title', 'Pembayaran')

@section('content')
    <div class="container py-5">
        <div class="row" style="margin-top: 50px;">

            <div class="card-body">
                <div class="row justify-content-center mb-2 text-center">
                    @foreach ($rekenings as $rekening)
                        <div class="col-md-3">
                            <div class="card text-white bg-info mb-3 " style="max-width: 18rem;">
                                <div class="card-header">{{ $rekening->nama }}</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $rekening->no_rekening }}</h5>
                                    <p class="card-text">Atas Nama {{ $rekening->atas_nama }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row  mb-4">
                    <div class="col-md-12 text-center">
                        Transfer Sebesar Rp
                        {{ number_format($transaksi->total_pembayaran, 2, ',', '.') }}
                        Ke No Rekening Di Atas
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <form action="{{ route('transaksi.upload_receipt') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $transaksi->id }}">
                            <div class="form-group">
                                <label for="">Upload Bukti Pembayaran</label>
                                <input type="file" name="bukti_transfer" id="" class="form-control" required>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
