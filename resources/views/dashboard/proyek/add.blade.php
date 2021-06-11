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
    <form action="{{ url('/dashboard/proyek/data') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Proyek</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label for="">Nama Kontraktor</label>
                                <select name="kontraktor" class="form-control @error('kontraktor') is-invalid @enderror"
                                    id="">
                                    <option value="">Pilih Kontraktor</option>
                                    @foreach ($kontraktor as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('kontraktor') == $item->id ? 'selected' : '' }}>{{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kontraktor')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="">Proyek</label>
                                <select name="proyek" class="form-control @error('proyek') is-invalid @enderror" id="">
                                    <option value="">Pilih Proyek</option>
                                    @foreach ($proyek as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('proyek') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_kavling . ' No ' . $item->no_kavling . ' tipe ' . $item->nama_tipe }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="">Target Selesai</label>
                                <input type="date" value="{{ old('target_selesai') }}" class="form-control"
                                    name="target_selesai" id="">
                                @error('target_selesai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-lg-12 text-right mt-4">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

@endsection
