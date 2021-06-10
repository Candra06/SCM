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
                    <h6 class="m-0 font-weight-bold text-primary">Detail Pembelian Kavling</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 ">
                            <label for="">Nama Kavling</label>
                            <p><b>{{ $detailPembelian->nama_kavling . ' No ' . $detailPembelian->no_kavling }}</b></p>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Tipe Rumah</label>
                            <p><b>{{ $detailPembelian->nama_tipe }}</b></p>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Harga Jual</label>
                            <p><b>{{ Helper::price($detailPembelian->harga_jual) }}</b></p>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Harga Fix</label>
                            <p><b>{{ $detailPembelian->harga_fix == null ? '-' : Helper::price($detailPembelian->harga_fix) }}</b>
                            </p>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Jumlah ITJ</label>
                            <p><b>{{ $detailPembelian->jumlah_itj == null ? '-' : Helper::price($detailPembelian->jumlah_itj) }}</b>
                            </p>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Tanggal ITJ</label>
                            <p><b>{{ $detailPembelian->tanggal_itj == null ? '-' : Helper::formatTanggal($detailPembelian->tanggal_itj) }}</b>
                            </p>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Metode Bayar</label>
                            <p><b>{{ $detailPembelian->metode_bayar == null ? '-' : $detailPembelian->metode_bayar }}</b>
                            </p>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Jumlah Angsuran</label>
                            <p><b>{{ $detailPembelian->jumlah_angsuran == null ? '-' : $detailPembelian->jumlah_angsuran }}</b>
                            </p>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Besar Angsuran</label>
                            <p><b>{{ $detailPembelian->besar_angsuran == null ? '-' : Helper::price($detailPembelian->besar_angsuran) }}</b>
                            </p>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Status</label>
                            <p><b>{{ $detailPembelian->status }}</b></p>
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
                    <h6 class="m-0 font-weight-bold text-primary">Angsuran</h6>
                </div>
                <div class="card-body">

                    @if (!$angsuran)
                        <h2>Belum ada angsuran</h2>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Status Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($angsuran as $m)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ Helper::formatTanggal($m->tanggal_bayar) }}</td>

                                            <td>
                                                @if ($m->status == 'Pending')
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif ($m->status == 'Confirm')
                                                    <span class="badge badge-success">Confirm</span>
                                                @elseif ($m->status == 'Ditolak')
                                                    <span class="badge badge-danger">Ditolak</span>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif


                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Proyek</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if (empty($detailProyek))
                            <div class="col-md-12 align-center">
                                <h2>Proyek belum dimulai</h2>
                            </div>
                        @else
                            <div class="col-md-4">
                                <label for="">Nama Kontraktor</label>
                                <p><b>{{ $detailProyek->nama == null ? '-' : $detailProyek->nama }}</b>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <label for="">Telepon Kontraktor</label>
                                <p><b>{{ $detailProyek->telepon == null ? '-' : $detailProyek->telepon }}</b>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <label for="">Tanggal Selesai</label>
                                <p><b>{{ $detailProyek->target_selesai == null ? '-' : Hellper::formatTanggal($detailProyek->target_selesai) }}</b>
                                </p>
                            </div>
                        @endif
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
                    @if (empty($ProgresProyek))
                        <h2>Proyek belum dimulai</h2>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ProgresProyek as $m)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ Helper::formatTanggal($m->tanggal) }}</td>

                                            <td>
                                               {{$m->keterangan}}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>

@endsection
