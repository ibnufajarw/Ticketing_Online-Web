@extends('template.dashboard.app')

@section('title', 'Acara')

@push('styles')
    <link href="{{ asset('dashboard-assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Acara</h1>

    @if (session('success'))
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success">{{ session('success') }}</div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Jenis Tiket</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between pl-0 align-items-center flex-wrap">
                            <span>Acara</span>
                            <a href="">{{ $acara->judul }}</a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between pl-0 align-items-center flex-wrap">
                            <span>Kuota</span>
                            <a>{{ $acara->kuota }}</a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between pl-0 align-items-center">
                            <span>Gratis</span>
                            @if ($tiket_gratis)
                                <form action="{{ route('dashboard.jenis-tiket.delete', $acara->id) }}" method="POST">
                                    <div>
                                        <a href="{{ url('/dashboard/acara/' . $acara->id . '/jenis-tiket?jenis=gratis') }}"
                                            class="btn btn-sm btn-secondary">Lihat Tiket
                                            ({{ $tiket_gratis->tiket_count }})</a>
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="jenis" value="gratis">
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </div>
                                </form>
                            @else
                                <small class="text-muted">Belum ada, <a href="#" data-type="Gratis"
                                        class="btn-modal-jenis-tiket">tambah sekarang</a></small>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between pl-0 align-items-center">
                            <span>Berbayar</span>
                            @if ($tiket_berbayar)
                            <form action="{{ route('dashboard.jenis-tiket.delete', $acara->id) }}" method="POST">
                                <div>
                                    <a href="{{ url('/dashboard/acara/' . $acara->id . '/jenis-tiket?jenis=berbayar') }}"
                                        class="btn btn-sm btn-secondary">Lihat Tiket
                                        ({{ $tiket_berbayar->tiket_count }})</a>
                                    @method('delete')
                                    @csrf
                                    <input type="hidden" name="jenis" value="berbayar">
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </div>
                            </form>
                            @else
                                <small class="text-muted">Belum ada, <a href="#" data-type="Berbayar"
                                        class="btn-modal-jenis-tiket">tambah sekarang</a></small>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Tiket {{ ucwords($jenis_tiket) }}
                            ( {{ $tikets }} dari
                            @if ($jenis_tiket == 'gratis')
                                {{ $tiket_gratis ? $tiket_gratis->kuota : '0' }}
                            @else
                                {{ $tiket_berbayar ? $tiket_berbayar->kuota : '0' }}
                            @endif
                            )
                        </h6>

                        <a href="#" data-toggle="modal" data-target="#modalTiket"
                            class="btn btn-sm btn-primary btn-modal-tiket">Tambah Data</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Created At</th>
                                    <th>Kode</th>
                                    <th>Tier</th>
                                    <th>Kursi</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal jenis tiket --}}
    <div class="modal fade" id="modalJenisTiket" tabindex="-1" aria-labelledby="modalJenisTiket" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('dashboard.jenis-tiket.store', $acara->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalJenisTiket">Tambah Jenis Tiket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="is_free">
                        <div class="form-group">
                            <label for="jenis_tiket">Jenis Tiket</label>
                            <input type="text" class="form-control" id="jenis_tiket" name="jenis_tiket" readonly>
                        </div>
                        <div class="form-group">
                            <label for="kuota">Kuota</label>
                            <input type="text" class="form-control" id="kuota" name="kuota">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal tiket --}}
    <div class="modal fade" id="modalTiket" tabindex="-1" aria-labelledby="modalTiket" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('dashboard.tiket.store', $acara->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTiket">Tambah Tiket {{ ucwords($jenis_tiket) }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="jenis_tiket" value="{{ $jenis_tiket }}">
                        <div class="form-group">
                            <label for="tier">Tier</label>
                            <input type="text" class="form-control" id="tier" name="tier"
                                placeholder="opsional">
                            <small class="text-muted">Contoh: VIP, Reguler</small>
                        </div>
                        <div class="form-group">
                            <label for="kursi">Nomor Kursi</label>
                            <input type="text" class="form-control" id="kursi" name="kursi"
                                placeholder="opsional">
                            <small class="text-muted">Contoh: A4, B5</small>
                        </div>
                        @if ($jenis_tiket == 'berbayar')
                            <div class="form-group">
                                <label for="harga">Harga <span class="text-danger">*</span></label>
                                <input type="number" min="1" class="form-control" id="harga" name="harga"
                                    required>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('dashboard-assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
            // click modal add jenis tiket
            $('.btn-modal-jenis-tiket').on('click', function(e) {
                const type = $(this).attr('data-type');
                const modal = $('#modalJenisTiket');
                const is_free = (type === 'Gratis' ? 1 : 0);

                modal.find('input[name="is_free"]').val(is_free);
                modal.find('input[name="jenis_tiket"]').val(type);
                modal.modal('show');
            });

            // datatable tiket
            const table = $('table').DataTable({
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('dashboard.tiket.datatable-json', $acara->id) }}",
                    type: 'GET',
                    data: {
                        jenis_tiket: "{{ $jenis_tiket }}"
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'kode',
                        name: 'kode'
                    },
                    {
                        data: 'tier',
                        name: 'tier'
                    },
                    {
                        data: 'kursi',
                        name: 'kursi'
                    },
                    {
                        data: 'harga',
                        name: 'harga'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    }
                ],
                columnDefs: [{
                        targets: 5,
                        orderable: false
                    },
                    {
                        targets: 0,
                        visible: false
                    },
                    {
                        targets: 5,
                        searchable: false
                    }
                ],
                order: [
                    [0, 'desc']
                ]
            });
        });
    </script>
@endpush
