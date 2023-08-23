@extends('template.dashboard.app')

@section('title', 'Transaksi')

@push('styles')
    <link href="{{ asset('dashboard-assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Transaksi</h1>

    <div class="row">
        <div class="col-lg-12">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
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
                                    <th>Created At</th>
                                    <th>Kode Transaksi</th>
                                    <th>Acara</th>
                                    <th>Tiket</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('transaksi.confirm') }}" method="POST">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Data Transaksi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="custom-select" required>
                                <option value="MENUNGGU">MENUNGGU</option>
                                <option value="DIBAYAR">DIBAYAR</option>
                                <option value="DITOLAK">DITOLAK</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Konfirmasi</button>
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
            const table = $('table').DataTable({
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('pembelian.index') }}",
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'kode_transaksi',
                        name: 'thumbnail'
                    },
                    {
                        data: 'acara',
                        render: function(data) {
                            return $('<div/>').html(data).text();
                        }
                    },
                    {
                        data: 'tiket',
                        name: 'tiket'
                    },
                    {
                        data: 'harga',
                        name: 'harga'
                    },
                    {
                        data: 'status',
                        render: function(data) {
                            return $('<div/>').html(data).text();
                        }
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                columnDefs: [{
                        targets: [6, 1],
                        orderable: false
                    },
                    {
                        targets: 0,
                        visible: false
                    },
                    {
                        targets: 1,
                        searchable: false
                    }
                ],
                order: [
                    [0, 'desc']
                ]
            });


            $('#confirm').on('show.bs.modal', (e) => {
                var id = $(e.relatedTarget).data('id');
                var status = $(e.relatedTarget).data('status');
                $('#confirm').find('input[name="id"]').val(id);
                $('#confirm').find('select[name="status"]').val(status);
            });
        });
    </script>
@endpush
