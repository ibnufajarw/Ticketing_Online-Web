<form action="{{ isset($lokasi) ? route('dashboard.lokasi.update', $lokasi->id) : route('dashboard.lokasi.store') }}" method="POST">
    @csrf

    @if(isset($lokasi))
        @method('PUT')
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ isset($lokasi) ? 'Edit' : 'Tambah' }} Lokasi</h6>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="nama">Nama Lokasi <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ isset($lokasi) ? $lokasi->nama : old('nama') }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('dashboard.lokasi.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
        </div>
    </div>
</form>