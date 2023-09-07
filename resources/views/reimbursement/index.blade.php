@extends('layouts.app')
@section('title')
    {{ Route::is('admin.*') ? 'Direktur' : 'Staff' }}
@endsection
@section('page-title')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0">
            Reimbursement
        </h1>
    </div>
@endsection
@section('content')
    <div class="card card-docs flex-row-fluid mb-2">
        <div class="card-header d-flex justify-content-between">
            <div class="d-flex align-items-center position-relative my-1 mb-2 mb-md-0">
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                        <path
                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                            fill="currentColor" />
                    </svg>
                </span>
                <input type="search" name="search" class="form-control form-control-solid w-250px ps-15" id="search" placeholder="Cari.." />
            </div>
            <div class="d-flex flex-stack">
                    <a type="button" class="btn btn-primary ms-2" href="{{ route('reimbursement.create') }}">
                        Tambah Data Reimbursement
                    </a>
            </div>
        </div>
        <div class="card-body pt-0">
            <table id="reimbursement-table" class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th class="text-start min-w-20px">No</th>
                        <th class="text-start min-w-100px">Gambar</th>
                        <th class="text-start min-w-100px">Tanggal</th>
                        <th class="text-start min-w-100px">Nama Reimbursement</th>
                        <th class="text-start min-w-100px">Deskripsi</th>
                        <th class="text-start min-w-100px">Status</th>
                        <th class="text-end min-w-100px">Aksi</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var datatableReimbursement = $('#reimbursement-table').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            stateSave: false,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: true,
                    searchable: true,
                    width: '5%'
                },
                {
                    data: 'photo',
                    name: 'photo',
                    orderable: true,
                    searchable: true,
                    width: '20%'
                },
                {
                    data: 'date',
                    name: 'date',
                    orderable: true,
                    searchable: true,
                    width: '20%'
                },
                {
                    data: 'name_reimbursement',
                    name: 'name_reimbursement',
                    orderable: true,
                    searchable: true,
                    width: '20%'
                },
                {
                    data: 'description',
                    name: 'description',
                    orderable: true,
                    searchable: true,
                    width: '20%'
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: true,
                    searchable: true,
                    width: '20%'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: true,
                    searchable: true,
                    width: '15%'
                },           
            ],
            order: [
                [0, "asc"]
            ]
        })

        $('#search').on('keyup', function() {
            datatable.search(this.value).draw();
        });

        $(document).on("click", ".delete-confirm", function(e) {
            e.preventDefault();
            Swal.fire({
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-light'
                },
                title: 'Apakah anda yakin?',
                text: "Apakah anda yakin ingin menghapus data ini?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.preventDefault();
                    var id = $(this).data("id");
                    var route = "{{ route('reimbursement.destroy', ':id') }}";
                    route = route.replace(':id', id);
                    $.ajax({
                        url: route,
                        type: 'DELETE',
                        data: {
                            _token: $("meta[name='csrf-token']").attr("content"),
                            id: id
                        },
                        success: function(response) {
                            Swal.fire({
                                customClass: {
                                    confirmButton: 'btn btn-success',
                                },
                                title: 'Success',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            })
                            datatable.ajax.reload();
                        },
                        error: function(xhr) {
                            var json = JSON.parse(xhr.responseText);
                            Swal.fire({
                                customClass: {
                                    confirmButton: 'btn btn-success',
                                },
                                title: 'Error',
                                text: json.error,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            })
                        }
                    });
                }
            })
        });
    </script>
@endpush
