@extends('layouts.app')
@section('title','Tambah User')
@section('page-title')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0">
            Tambah User
        </h1>
    </div>
@endsection
@section('content')
    <div class="card card-docs flex-row-fluid mb-2">
        <div class="card-body fs-6 text-gray-700">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center text-center my-0">
                    User Detail
                </h1>
            </div>
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body p-9">
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="nip" class="fs-6 fw-bold mt-2 mb-3">NIP</label>
                        </div>
                        <div class="col-lg">
                        <input type="number" name="nip" class="form-control @error('nip') is-invalid @enderror " placeholder="NIP" />
                        @error('nip')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>  
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="name" class="fs-6 fw-bold mt-2 mb-3">Nama User</label>
                        </div>
                        <div class="col-lg">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror " placeholder="Nama User " />
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>             
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="role" class="fs-6 fw-bold mt-2 mb-3">Role</label> 
                        </div>    
                        <div class="col-lg">                                     
                            <select name="role" class="form-select  @error('role') is-invalid @enderror " data-control="select2" data-hide-search="true">
                                <option value="">Pilih Status</option>
                                <option {{ $user->role == 'Finance' ? 'selected' : '' }} value="Finance">Finance</option>
                                <option {{ $user->role == 'Staff' ? 'selected' : '' }} value="Staff">Staff</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="password" class="fs-6 fw-bold mt-2 mb-3">Password</label>
                        </div>
                        <div class="col-lg">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror " placeholder="Password" />
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>        
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('user.index') }}" type="reset" class="btn btn-light btn-active-light-primary me-2">Batalkan</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection