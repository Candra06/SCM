
@extends('dashboard.templates.master')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/dropify.min.css') }}">
    <style>
        .mce-notification.mce-in {
            display: none !important;
        }
        .dropify-wrapper .dropify-message p {
            font-size: 14px !important;
        }
    </style>
@endpush
@section('content')
@if (session('status'))
    <div class="alert alert-danger" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<form action="/dashboard/supplier/data" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Detail Data Supplier</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <input type="text" name="id_akun" value="{{$datasupplier}}" class="form-control @error('id_akun') is-invalid @enderror" placeholder="Id Akun">
                            @error('id_akun')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-3">
                            <input type="text" name="nama_supplier" class="form-control @error('nama_supplier') is-invalid @enderror" placeholder="Nama Supplier">
                            @error('nama_supplier')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-3">
                            <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror" placeholder="Telepon">
                            @error('telepon')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-3">
                            <input type="text" name="alamat_supplier" class="form-control @error('alamat_supplier') is-invalid @enderror" placeholder="Alamat Supplier">
                            @error('alamat_supplier')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="form-control @error('status') is-invalid @enderror" name="status">
                                    <option value="">Select Status</option>
                                    <option value="Aktif" {{old('status') == 'Aktif' ? 'selected' : ''}}>Aktif</option>
                                    <option value="Banned" {{old('status') == 'Banned' ? 'selected' : ''}}>Banned</option>
                                </select>
                                @error('url')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 text-right">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>

@endsection
