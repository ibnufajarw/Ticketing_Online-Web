@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}</div>
@endif

<form action="{{ isset($kampus) ? route('dashboard.kampus.update', $kampus->id) : route('dashboard.kampus.store') }}"
    method="POST" enctype="multipart/form-data">
    @csrf

    @if (isset($kampus))
        @method('PUT')
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ isset($kampus) ? 'Edit' : 'Tambah' }} Kampus</h6>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="thumbnail">Thumbnail</label>
                <input type="file" class="form-control-file @error('thumbnail') is-invalid @enderror"
                    name="thumbnail" id="thumbnail">
                <small class="text-muted">Format: JPG,JPEG,PNG | Maks: 2Mb @if (isset($kampus) && $kampus->thumbnail)
                        | <a href="{{ $kampus->thumbnail }}" target="_blank">Lihat foto</a>
                    @endif
                </small>
                @error('thumbnail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- <div class="form-group">
                <label for="lokasi_id">Lokasi <span class="text-danger">*</span></label>
                <select class="form-control" name="lokasi_id" id="lokasi_id" required>
                    <option value="">Pilih Lokasi</option>
                    @foreach ($lokasi as $l)
                        <option {{ (isset($kampus) && $kampus->lokasi_id == $l->id) || old('lokasi_id') == $l->id ? 'selected' : '' }} value="{{ $l->id }}">{{ $l->nama }}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="form-group">
                <label for="nama">Nama Kampus <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                    id="nama" value="{{ isset($kampus) ? $kampus->nama : old('nama') }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('dashboard.kampus.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
        </div>
    </div>
</form>
