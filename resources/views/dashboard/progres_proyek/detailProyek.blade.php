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
                    <h6 class="m-0 font-weight-bold text-primary">Detail Proyek</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                            <div class="col-md-4">
                                <label for="">Nama Kontraktor</label>
                                <p><b>{{ $data->nama == null ? '-' : $data->nama }}</b>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <label for="">Kavling</label>
                                <p><b>{{  $data->nama_kavling.' Nomor '.$data->no_kavling }}</b>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <label for="">Tipe</label>
                                <p><b>{{ $data->nama_tipe }}</b>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <label for="">jumlah Lantai Bangunan</label>
                                <p><b>{{ $data->jumlah_lantai." Lantai"}}</b>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <label for="">Tanggal Selesai</label>
                                <p><b>{{  Helper::formatTanggal($data->target_selesai) }}</b>
                                </p>
                            </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Progres Proyek</h6>
                </div>
                <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($progres as $m)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ Helper::formatTanggal($m->tanggal) }}</td>
                                            <td>{{$m->keterangan}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <form action="/dashboard/progres-proyek/data" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Progres Proyek</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <input type="text" name="proyek_id" value="{{($id)}}" class="form-control @error('proyek_id') is-invalid @enderror" readonly>
                                @error('proyek_id')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="text" name="keterangan" value="{{old('keterangan')}}" class="form-control @error('keterangan') is-invalid @enderror" placeholder="Keterangan">
                                @error('keterangan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="date" name="date" value="{{old('date')}}" class="form-control @error('date') is-invalid @enderror">
                                @error('date')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
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
