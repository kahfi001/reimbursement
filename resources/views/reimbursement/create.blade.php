@extends('layouts.app')
@section('title','Tambah User')
@section('page-title')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0">
            Tambah Reimbursement
        </h1>
    </div>
@endsection
@section('content')
    <div class="card card-docs flex-row-fluid mb-2">
        <div class="card-body fs-6 text-gray-700">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center text-center my-0">
                   Reimbursement
                </h1>
            </div>
            <form action="{{ route('reimbursement.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body p-9">
                    <div class="row mb-5">
                        <div class="col-xl-3">                     
                            <label for="photo" class="fs-6 fw-bold mt-2 mb-3">Foto</label>
                        </div>
                        <div class="col-lg">
                            <div class="image-input image-input-empty " data-kt-image-input="true" style="background-image: url({{ asset('assets/images/blank.png') }})">
                                <div class="image-input-wrapper w-125px h-125px"></div>
                                <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Change favicon">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <input type="file" name="photo" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="favicon_remove" />
                                </label>
                                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Cancel favicon">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Remove favicon">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="name_reimbursement" class="fs-6 fw-bold mt-2 mb-3">Nama Reimbursement</label>
                        </div>
                        <div class="col-lg">
                        <input type="input" name="name_reimbursement" class="form-control @error('name_reimbursement') is-invalid @enderror " placeholder="Nama Reimbursement" />
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
                            <textarea  name="description" class="form-control @error('description') is-invalid @enderror " placeholder="Deskripsi" ></textarea>
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
                            <input type="date" name="date" class="form-control @error('date') is-invalid @enderror " placeholder="Deskripsi" />
                            @error('date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>             
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('reimbursement.index') }}" type="reset" class="btn btn-light btn-active-light-primary me-2">Batalkan</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection