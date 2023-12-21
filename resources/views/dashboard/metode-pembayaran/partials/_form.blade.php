@if(session('error'))
   <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form action="{{ isset($metode_pembayaran) ? route('dashboard.metode-pembayaran.update', $metode_pembayaran->id) : route('dashboard.metode-pembayaran.store') }}" method="POST" enctype="multipart/form-data">
   @csrf

   @if(isset($metode_pembayaran))
      @method('PUT')
   @endif

   <div class="card shadow mb-4">
      <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">{{ isset($metode_pembayaran) ? 'Edit' : 'Tambah' }} Metode Pembayaran</h6>
      </div>
      <div class="card-body">
         <div class="form-group">
               <label for="logo">Logo</label>
               <input type="file" class="form-control-file @error('logo') is-invalid @enderror" name="logo" id="logo">
               <small class="text-muted">Format: JPG,JPEG,PNG | Maks: 2Mb @if(isset($metode_pembayaran) && $metode_pembayaran->logo) | <a href="{{ $metode_pembayaran->logo }}" target="_blank">Lihat foto</a> @endif</small>
               @error('logo')
                  <div class="invalid-feedback">{{ $message }}</div>
               @enderror
         </div>
         <div class="form-group">
            <label for="jenis">Jenis <span class="text-danger">*</span></label>
            <div class="input-group">
               <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="jenis" id="jenis_bank" value="bank" {{ !old('jenis') || old('jenis') == 'bank' || (isset($metode_pembayaran) && $metode_pembayaran->jenis == 'bank') ? 'checked' : '' }}>
                  <label class="form-check-label" for="jenis_bank">Bank</label>
               </div>
               <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="jenis" id="jenis_dompet_digital" value="dompet_digital" {{ old('jenis') == 'dompet_digital' || (isset($metode_pembayaran) && $metode_pembayaran->jenis == 'dompet_digital') ? 'checked' : '' }}>
                  <label class="form-check-label" for="jenis_dompet_digital">Dompet Digital</label>
               </div>
            </div>
         </div>
         <div class="form-group">
            <label for="nama">Nama Metode Pembayaran <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ isset($metode_pembayaran) ? $metode_pembayaran->nama : old('nama') }}" required>
            @error('nama')
               <div class="invalid-feedback">{{ $message }}</div>
            @enderror
         </div>
         <div class="form-group">
            <label for="no_rekening">Nomor Rekening <span class="text-danger">*</span></label>
            <input type="number" min="0" class="form-control" name="no_rekening" id="no_rekening" value="{{ isset($metode_pembayaran) ? $metode_pembayaran->no_rekening : old('no_rekening') }}" required>
            <small class="text-muted">Dapat diisikan nomor telepon, nomor virtual account</small>
         </div>
         <div class="form-group">
            <label for="atas_nama">Atas Nama <span class="text-danger">*</span></label>
            <input type="text" min="0" class="form-control" name="atas_nama" id="atas_nama" value="{{ isset($metode_pembayaran) ? $metode_pembayaran->atas_nama : old('atas_nama') }}" required>
         </div>
      </div>
      <div class="card-footer">
         <a href="{{ route('dashboard.metode-pembayaran.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
         <button type="submit" class="btn btn-sm btn-success">Simpan</button>
      </div>
   </div>
</form>