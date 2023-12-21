<form action="{{ isset($slider) ? route('dashboard.slider.update', $slider->id) : route('dashboard.slider.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @if(isset($slider))
        @method('PUT')
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ isset($slider) ? 'Edit' : 'Tambah' }} Slider</h6>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="judul">Judul <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" id="judul" value="{{ isset($slider) ? $slider->judul : old('judul') }}" required>
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" value="{{ isset($slider) ? $slider->deskripsi : old('deskripsi') }}" required>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

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
        </div>
        <div class="card-footer">
            <a href="{{ route('dashboard.slider.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
        </div>
    </div>
</form>