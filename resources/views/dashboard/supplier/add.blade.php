
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
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Data Suplier</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <input type="text" name="nama_supplier" value="{{old('nama_supplier')}}" class="form-control @error('nama_supplier') is-invalid @enderror" placeholder="Nama Supplier">
                                @error('nama_supplier')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="text" name="telepon" value="{{old('telepon')}}" class="form-control @error('telepon') is-invalid @enderror" placeholder="Nomer Telepon">
                                @error('telepon')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="text" name="alamat" value="{{old('alamat')}}" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat">
                                @error('alamat')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="text" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="password" name="password" value="{{old('password')}}" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
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
                        <div>
                            <button class="btn btn-primary btn-block" type="submit">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

@endsection
@push('scripts')
    <script src="{{asset('assets/js/tinymce.min.js')}}"></script>
    <script src="{{asset('assets/js/tinymce.js')}}"></script>
    <script src="{{ asset('assets/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/js/dropify.js') }}"></script>
@endpush
