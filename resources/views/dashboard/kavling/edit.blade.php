
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
<form action="/dashboard/kavling/index/{{$kavling->id}}" enctype="multipart/form-data" method="POST">
    @method('put')
    @csrf
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Kavling</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <input type="text" name="nama_kavling" value="{{$kavling->nama_kavling}}" class="form-control @error('nama_kavling') is-invalid @enderror" placeholder="Nama Kavling">
                            @error('nama_kavling')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-3">
                            <input type="text" name="no_kavling" value="{{$kavling->no_kavling}}" class="form-control @error('no_kavling') is-invalid @enderror" placeholder="Nomor Kavling">
                            @error('no_kavling')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="form-control @error('status') is-invalid @enderror" name="status">
                                    <option value="">Select Status</option>
                                    <option value="Ready" {{$kavling->status == 'Ready' ? 'selected' : ''}}>Ready</option>
                                    <option value="Sold Out" {{$kavling->status == 'Sold Out' ? 'selected' : ''}}>Sold Out</option>
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
