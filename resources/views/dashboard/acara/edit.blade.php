@extends('template.dashboard.app')

@section('title', 'Acara')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Acara</h1>

    <form action="{{ route('dashboard.acara.update', $acara->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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
                            <small class="text-muted">Format: JPG,JPEG,PNG | Maks: 2Mb @if (isset($acara) && $acara->thumbnail)
                                    | <a href="{{ Storage::disk('local')->url($acara->thumbnail) }}" target="_blank">Lihat
                                        foto</a>
                                @endif
                            </small>
                            @error('thumbnail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="judul">Judul Acara <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul"
                                id="judul" value="{{ $acara->judul }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kontak">Kontak Panitia <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kontak') is-invalid @enderror" name="kontak"
                                id="kontak" value="{{ $acara->kontak }}" required>
                            @error('kontak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="social_media">Social Media <span class="text-danger">*</span></label>
                            <textarea rows="10" class="form-control" name="social_media" value="{{ $acara->social_media }}" id="social_media" required>{{ $acara->social_media }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="kampus_id">Kampus</label>
                            <select class="form-control" name="kampus_id" id="kampus_id">
                                <option value="">Bukan acara kampus</option>
                                @foreach ($kampus as $k)
                                    <option value="{{ $k->id }}" {{ $acara->kampus_id == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="kategori_id">Kategori <span class="text-danger">*</span></label>
                            <select class="form-control" name="kategori_id" id="kategori_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}"
                                        {{ $acara->kategori_id == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                            <textarea rows="5" class="form-control" name="deskripsi" id="deskripsi" required>{{ $acara->deskripsi }}</textarea>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="waktu_mulai">Waktu Mulai <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control @error('waktu_mulai') is-invalid @enderror"
                                    name="waktu_mulai" id="waktu_mulai" value="{{ $acara->waktu_mulai }}" required>
                                @error('waktu_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="waktu_selesai">Waktu Selesai <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control @error('waktu_selesai') is-invalid @enderror"
                                    name="waktu_selesai" id="waktu_selesai" value="{{ $acara->waktu_selesai }}" required>
                                @error('waktu_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kuota">Kuota <span class="text-danger">*</span></label>
                            <input type="number" min="1" class="form-control @error('kuota') is-invalid @enderror"
                                name="kuota" id="kuota" value="{{ $acara->kuota }}" required>
                            @error('kuota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat Lokasi <span class="text-danger">*</span></label>
                            <textarea rows="5" class="form-control" name="alamat" value="{{ $acara->alamat }}" id="alamat" required
                                placeholder="Masukkan alamat jalan, nomor, nama gedung...">{{ $acara->alamat }}</textarea>
                        </div>
                        {{-- <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="latitude">Latitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('latitude') is-invalid @enderror"
                                    name="latitude" value="{{ $acara->latitude }}" id="latitude"
                                    value="{{ $acara->latitude }}" required placeholder="Contoh: -6.123456">
                                @error('latitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="longitude">Longitude <span class="text-danger">*</span></label>
                                <input type="text" min="1"
                                    class="form-control @error('longitude') is-invalid @enderror"
                                    name="longitude"value="{{ $acara->longitude }}" id="longitude"
                                    value="{{ $acara->longitude }}" required placeholder="Contoh: 106.789012">
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
                        <h6 class="m-0 font-weight-bold text-primary">Keterangan</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="foto_stage">Foto Stage</label>
                            <input type="file" class="form-control-file @error('foto_stage') is-invalid @enderror"
                                name="foto_stage" id="foto_stage">
                            <small class="text-muted">Format: JPG,JPEG,PNG | Maks: 2Mb @if (isset($acara) && $acara->foto_stage)
                                    | <a href="{{ Storage::disk('local')->url($acara->foto_stage) }}"
                                        target="_blank">Lihat foto</a>
                                @endif
                            </small>
                            @error('foto_stage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="dress_code">Dress Code</label>
                            <input type="text" class="form-control" name="dress_code" id="dress_code"
                                value="{{ isset($acara) ? $acara->dress_code : $acara->dress_code }}">
                        </div>
                        <div class="form-group">
                            <label for="peraturan">Peraturan Kegiatan</label>
                            <textarea rows="5" class="form-control" name="peraturan" id="peraturan" required>{{ isset($acara) ? $acara->peraturan : $acara->peraturan }}</textarea>
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(function() {
            $('#deskripsi').summernote();
            $('#peraturan').summernote();
            $('#social_media').summernote();
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
