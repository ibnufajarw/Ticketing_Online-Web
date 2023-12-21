@extends('template.dashboard.app')

@section('title', 'Kampus')

@push('styles')
    <link href="{{ asset('dashboard-assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Kampus</h1>

    <div class="row">
        <div class="col-lg-12">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Data Kampus</h6>
                        <a href="{{ route('dashboard.kampus.create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Thumbnail</th>
                                    <th>Nama Kampus</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('dashboard-assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function() {
            const table = $('table').DataTable({
                lengthMenu: [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('dashboard.kampus.datatable-json') }}",
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [
                    { data: 'thumbnail', name: 'thumbnail' },
                    { data: 'nama', name: 'nama' },
                    { data: 'aksi', name: 'aksi' }
                ],
                columnDefs: [
                    {
                        targets: [0, 2],
                        orderable: false
                    }
                ],
                order: [[1, 'asc']]
            });

            // delete
            $(document).on('click', '.btn-danger', function() {
                const id = $(this).attr('data-id');

                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Data akan dihapus secara permanen",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('/dashboard/kampus') }}/"+id,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            success: function(res) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sukses',
                                    text: res.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(() => table.ajax.reload());
                            },
                            error: function(err) {  
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Data gagal dihapus',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            }
                        });
                    }
                })
            });
        });
    </script>
@endpush