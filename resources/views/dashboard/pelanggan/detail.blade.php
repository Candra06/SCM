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


    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Pelanggan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 ">
                            <label for="">Nama</label>
                            <p><b>{{ $data->nama  }}</b></p>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">NIK</label>
                            <p><b>{{ $data->nik }}</b></p>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Telepon</label>
                            <p><b>{{ $data->telepon }}</b></p>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Profesi</label>
                            <p><b>{{ $data->profesi == null ? '-' : $data->profesi}}</b>
                            </p>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Instansi</label>
                            <p><b>{{ $data->instansi == null ? '-' : $data->instansi }}</b>
                            </p>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Alamat Instansi</label>
                            <p><b>{{ $data->alamat_instansi == null ? '-' : $data->alamat_instansi }}</b>
                            </p>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Telepon Instansi</label>
                            <p><b>{{ $data->tlpn_instansi == null ? '-' : $data->tlpn_instansi }}</b>
                            </p>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Alamat KTP</label>
                            <p><b>{{ $data->alamat_ktp == null ? '-' : $data->alamat_ktp }}</b>
                            </p>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Alamat Domisili</label>
                            <p><b>{{ $data->alamat_domisili == null ? '-' : $data->alamat_domisili }}</b>
                            </p>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Status</label>
                            <p><b>{{ $data->status }}</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
