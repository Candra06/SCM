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
                    <h6 class="m-0 font-weight-bold text-primary">Detail Pembelian Meterial</h6>
                </div>
                <div class="card-body">
                    <form action="{{ url('/dashboard/material/data/' . $data->id_pembelian) }}" method="post">
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="col-md-4 ">
                                <label for="">Nama Barang</label>
                                <p><b>{{ $data->nama_barang }}</b></p>
                            </div>
                            <div class="col-md-4 ">
                                <label for="">Harga</label>
                                <p><b>{{ Helper::price($data->harga) }}</b></p>
                            </div>
                            <div class="col-md-4 ">
                                <label for="">Jumlah</label>
                                <p><b>{{ $data->jumlah . ' ' . $data->satuan }}</b></p>
                            </div>
                            <div class="col-md-4 ">
                                <label for="">Total</label>
                                <p><b>{{ Helper::price($data->sub_total) }}</b></p>
                                </p>
                            </div>
                            <div class="col-md-4 ">
                                <label for="">Supplier</label>
                                <p><b>{{ $data->nama }}</b>
                                </p>
                            </div>
                            <div class="col-md-4 ">
                                <label for="">Metode Bayar</label>
                                <p><b>{{ $data->metode_bayar == null ? '-' : $data->metode_bayar }}</b>
                                </p>
                            </div>
                            <div class="col-md-4 ">
                                <label for="">Status</label>

                                <p><b>{{ $data->status }}</b></p>


                            </div>

                        </div>
                        @if (($data->status == 'Pending') && (Auth::user()->role_id == '5'))
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="hidden" name="status" value="Batal">
                                    <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Histori Pembelian</h6>
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
                                        @php
                                            $tgl = date('Y-m-d', strtotime($m->created_at));
                                        @endphp
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ Helper::formatTanggal($tgl) }}</td>

                                        <td>
                                            {{ $m->keterangan }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>

    </div>

@endsection
