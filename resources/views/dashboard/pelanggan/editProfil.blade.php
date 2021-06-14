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
    <form action="{{route("saveprofile", $user)}}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Edit Profil Pelanggan</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-6 form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" name="nama" value="{{ $data->nama }}"
                                    class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Kavling">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-6 form-group">
                                <label for="">NIK</label>
                                <input type="number" name="nik" value="{{ $data->nik }}"
                                    class="form-control @error('nik') is-invalid @enderror" placeholder="NIK">
                                @error('nik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-6 form-group">
                                <label for="">Telepon</label>
                                <input type="number" name="telepon" value="{{ $data->telepon }}"
                                    class="form-control @error('telepon') is-invalid @enderror"
                                    placeholder="Nomer Telepon">
                                @error('telepon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-6 form-group">
                                <label for="">Profesi</label>
                                <input type="text" name="profesi" value="{{ $data->profesi }}"
                                    class="form-control @error('profesi') is-invalid @enderror" placeholder="Profesi">
                                @error('profesi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-6 form-group">
                                <label for="">Alamat Domisili</label>
                                <textarea name="alamat_domisili" id="" cols="30" rows="2"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="Alamat Domisili">{{ $data->alamat_domisili == null ? '' : $data->alamat_domisili }}</textarea>

                                @error('alamat_domisili')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-6 form-group">
                                <label for="">Alamat KTP</label>
                                <textarea name="alamat_ktp" id="" cols="30" rows="2"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="Alamat KTP">{{ $data->alamat_ktp == null ? '' : $data->alamat_ktp }}</textarea>

                                @error('alamat_ktp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-6 form-group">
                                <label for="">Instansi</label>
                                <input type="text" name="instansi" value="{{ $data->instansi }}"
                                    class="form-control @error('instansi') is-invalid @enderror" placeholder="Instansi">
                                @error('instansi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-6 form-group">
                                <label for="">Telepon Instansi</label>
                                <input type="number" name="tlpn_instansi" value="{{ $data->tlpn_instansi }}"
                                    class="form-control @error('tlpn_instansi') is-invalid @enderror"
                                    placeholder="Telepon Instansi">
                                @error('tlpn_instansi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-6 form-group">
                                <label for="">Alamat Instansi</label>
                                <textarea name="alamat_instansi" id="" cols="30" rows="2"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="Alamat Domisili">{{ $data->alamat_instansi == null ? '' : $data->alamat_instansi }}</textarea>

                                @error('alamat_instansi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-6 form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" value="{{ $data->email }}"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-6 form-group">
                                <label for="">Password</label>
                                <input type="text" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Kosongkan jika tidak ingin dirubah">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
