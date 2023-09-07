@extends('layouts.app')
@section('title', 'Reimbursement')
@section('page-title')

    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0">
            @if(!Auth::user()->hasRole('Staff'))
            Validasi Reimbursement
            @else
            Edit Reimbursement
            @endif
        </h1>
    </div>
@endsection
@push('styles')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="card card-docs flex-row-fluid mb-2">
        <div class="card-body fs-6 text-gray-700">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center text-center my-0">
                    Reimbursement Detail
                </h1>
            </div>
            <form action="{{ route('reimbursement.update',$reimbursement->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body p-9">
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="photo" class="fs-6 fw-bold mt-2 mb-3">Foto</label>
                        </div>
                        <div class="col-lg">
                            <div class="image-input image-input-empty" data-kt-image-input="true" style="background-image: url({{ asset('storage/' . $reimbursement->photo) }})">
                                <div class="image-input-wrapper w-500px h-500px"></div>
                                <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Change image">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <input type="file" name="photo" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="favicon_remove" />
                                </label>
                                <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Remove image">
                                    <i class="bi bi-x fs-2"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="name_reimbursement" class="fs-6 fw-bold mt-2 mb-3">Nama Reimbursement</label>
                        </div>
                        <div class="col-lg">
                        <input type="input" name="name_reimbursement" class="form-control @error('name_reimbursement') is-invalid @enderror " value="{{ old('name_reimbursement') ? old('name_reimbursement') : ($reimbursement->name_reimbursement ?? '') }}" placeholder="Nama Reimbursement" />
                        @error('name_reimbursement')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>  
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="description" class="fs-6 fw-bold mt-2 mb-3">Deskripsi</label>
                        </div>
                        <div class="col-lg">
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Deskripsi">{{ old('description') ? old('description') : ($reimbursement->description ?? '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>             
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="date" class="fs-6 fw-bold mt-2 mb-3">Tanggal</label>
                        </div>
                        <div class="col-lg">
                            <input type="date" name="date" class="form-control @error('date') is-invalid @enderror " value="{{ old('date') ? old('date') : ($reimbursement->date ?? '') }}" placeholder="Pilih Tangga;" />
                            @error('date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>       
                    @if(!Auth::user()->hasRole('Staff'))
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="status" class="fs-6 fw-bold mt-2 mb-3">Status</label>
                        </div>
                        <div class="col-lg">
                            <select name="status" class="form-select  @error('status') is-invalid @enderror " data-control="select2" data-hide-search="true">
                                <option value="">Pilih Status</option>
                                {{-- <option {{ $reimbursement->status == 'pending' ? 'selected' : '' }} value="pending">Tahap Seleksi</option> --}}
                                <option {{ $reimbursement->status == 'approved' ? 'selected' : '' }} value="approved">Diterima</option>
                                <option {{ $reimbursement->status == 'rejected' ? 'selected' : '' }} value="rejected">Ditolak</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    @endif      
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('user.index') }}" type="reset" class="btn btn-light btn-active-light-primary me-2">Batalkan</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(document).on("click", "#delete-confirm", function(e) {
        Swal.fire({
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-light'
            },
            title: 'Apakah anda yakin?',
            text: "Apakah anda yakin ingin menghapus data ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                e.preventDefault();
                var id = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("article");
                var url = e.target;
                var route = `articles/${id}/destroy`;
                $.ajax({
                    url: route,
                    type: 'DELETE',
                    data: {
                        _token: token,
                        id: id
                    },
                });
                location.reload();
                return false;
            }
        })
    });
</script>
@endpush
