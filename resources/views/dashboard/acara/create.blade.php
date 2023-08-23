@extends('template.dashboard.app')

@section('title', 'Acara')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Acara</h1>

    <form action="{{ route('dashboard.acara.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if (session('error'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger">{{ session('error') }}</div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Detail Acara</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="thumbnail">Thumbnail</label>
                            <input type="file" class="form-control-file @error('thumbnail') is-invalid @enderror"
                                name="thumbnail" id="thumbnail">
                            <small class="text-muted">Format: JPG, JPEG, PNG | Max: 2MB</small>
                            @error('thumbnail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="judul">Judul Acara <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul"
                                id="judul" value="{{ old('judul') }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kampus_id">Kampus</label>
                            <select class="form-control" name="kampus_id" id="kampus_id">
                                <option value="">Bukan acara kampus</option>
                                @foreach ($kampus as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="kategori_id">Kategori <span class="text-danger">*</span></label>
                            <select class="form-control" name="kategori_id" id="kategori_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                            <textarea rows="5" class="form-control" name="deskripsi" id="deskripsi" required>{{ old('deskripsi') }}</textarea>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="waktu_mulai">Waktu Mulai <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control @error('waktu_mulai') is-invalid @enderror"
                                    name="waktu_mulai" id="waktu_mulai" value="{{ old('waktu_mulai') }}" required>
                                @error('waktu_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="durasi_menit_estimasi">Durasi Estimasi <span
                                        class="text-danger">*</span></label>
                                <input placeholder="Dalam menit" type="number" min="1"
                                    class="form-control @error('durasi_menit_estimasi') is-invalid @enderror"
                                    name="durasi_menit_estimasi" id="durasi_menit_estimasi"
                                    value="{{ old('durasi_menit_estimasi') }}" required>
                                @error('durasi_menit_estimasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kuota">Kuota <span class="text-danger">*</span></label>
                            <input type="number" min="1" class="form-control @error('kuota') is-invalid @enderror"
                                name="kuota" id="kuota" value="{{ old('kuota') }}" required>
                            @error('kuota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat Lokasi <span class="text-danger">*</span></label>
                            <textarea rows="5" class="form-control" name="alamat" id="alamat" required
                                placeholder="Masukkan alamat jalan, nomor, nama gedung...">{{ old('alamat') }}</textarea>
                        </div>
                        {{-- <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="latitude">Latitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('latitude') is-invalid @enderror"
                                    name="latitude" id="latitude" value="{{ old('latitude') }}" required
                                    placeholder="Contoh: -6.123456">
                                @error('latitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="longitude">Longitude <span class="text-danger">*</span></label>
                                <input type="text" min="1"
                                    class="form-control @error('longitude') is-invalid @enderror" name="longitude"
                                    id="longitude" value="{{ old('longitude') }}" required
                                    placeholder="Contoh: 106.789012">
                                @error('longitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Detail Lainnya</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="foto_stage">Foto Stage</label>
                            <input type="file" class="form-control-file @error('foto_stage') is-invalid @enderror"
                                name="foto_stage" id="foto_stage">
                            <small class="text-muted">Format: JPG,JPEG,PNG | Maks: 2Mb @if (isset($acara) && $acara->foto_stage)
                                    | <a href="{{ $acara->foto_stage }}" target="_blank">Lihat foto</a>
                                @endif
                            </small>
                            @error('foto_stage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="dress_code">Dress Code</label>
                            <input type="text" class="form-control" name="dress_code" id="dress_code"
                                value="{{ isset($acara) ? $acara->dress_code : old('dress_code') }}">
                        </div>
                        <div class="form-group">
                            <label for="peraturan">Peraturan</label>
                            <textarea rows="5" class="form-control" name="peraturan" id="peraturan">{{ isset($acara) ? $acara->peraturan : old('peraturan') }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('dashboard.acara.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection


@push('scripts')
    <script>
        $(function() {
            // get lokasi from kampus
            $('#kampus_id').on('change', function() {
                const kampus_id = $(this).find('option:selected').val();
                const lokasi_select = $('#lokasi_id');

                lokasi_select.val('');

                if (kampus_id) {
                    $.ajax({
                        url: "{{ url('/api/kampus') }}/" + kampus_id,
                        success: function(res) {
                            lokasi_select.val(res.data.lokasi_id);
                        },
                        error: function(err) {

                        }
                    });
                }
            });
        });
    </script>
@endpush
