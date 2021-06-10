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
    <form action="{{url('/dashboard/kontraktor/data')}}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Data Kontraktor</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <label for="">Nama Kontraktor</label>
                                <input type="text" name="nama" value="{{ old('nama') }}"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="Nama Kontraktor">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="">Telepon Kontraktor</label>
                                <input type="number" name="telepon" value="{{ old('telepon') }}"
                                    class="form-control @error('telepon') is-invalid @enderror"
                                    placeholder="Telepon">
                                @error('telepon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="">Alamat Kontraktor</label>
                               <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="" cols="30" placeholder="Alamat Kontraktor" rows="1">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="">Email Kontraktor</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Email">
                                @error('emil')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" value="{{ old('password') }}"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Role</label>
                                    <select class="form-control @error('role') is-invalid @enderror" name="role">
                                        <option value="">Pilih Role</option>
                                        @foreach ($role as $m)
                                            <option value="{{$m->id}}" {{ old('role') == $m->id ? 'selected' : '' }}>{{$m->role}}
                                            </option>
                                        @endforeach

                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">
                                            {{ $message }}
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
