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
                                <label for="">Nama Barang</label>
                                <p><b>{{  $data->nama_barang }}</b>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <label for="">Jumlah</label>
                                <p><b>{{ $data->jumlah." ".$data->satuan }}</b>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <label for="">Metode Pembayaran</label>
                                <p><b>{{ $data->metode_bayar}}</b>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <label for="">Total Harga</label>
                                <p><b>{{  Helper::price($data->sub_total) }}</b>
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
                                        <th>Total Harga</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($progres as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ Helper::price($item->total) }}</td>
                                            <td>{{$item->keterangan}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>

    </div>

    <form action="/dashboard/data-pemesanan-barang/data/{{$id}}" enctype="multipart/form-data" method="POST">
        @method('put')
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
                                <input type="text" name="progres_pembelian_barang_id" value="{{($id)}}" class="form-control @error('progres_pembelian_barang_id') is-invalid @enderror" readonly>
                                @error('progres_pembelian_barang_id')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 mb-3">
                                <select class="form-control @error('status') is-invalid @enderror" name="status">
                                    <option value="">Select Status</option>
                                    <option value="Pending" {{old('status') == 'Pending' ? 'selected' : ''}}>Pending</option>
                                    <option value="Batal" {{old('status') == 'Batal' ? 'selected' : ''}}>Batal</option>
                                    <option value="Diproses" {{old('status') == 'Diproses' ? 'selected' : ''}}>Diproses</option>
                                    <option value="Dikirim" {{old('status') == 'Dikirim' ? 'selected' : ''}}>Dikirim</option>
                                    <option value="Lunas" {{old('status') == 'Lunas' ? 'selected' : ''}}>Lunas</option>
                                </select>
                                @error('url')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
{{--                            <div class="col-lg-4 mb-3">--}}
{{--                                <input type="date" name="date" value="{{old('date')}}" class="form-control @error('date') is-invalid @enderror">--}}
{{--                                @error('date')--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    {{$message}}--}}
{{--                                </div>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
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
