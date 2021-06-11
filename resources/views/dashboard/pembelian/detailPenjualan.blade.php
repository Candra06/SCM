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
        <form action="{{url('/dashboard/pemesanan/data/'.$data->id)}}" method="post" class="form-group">
            @method('put')
            @csrf
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Detail Pembelian Kavling</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 ">
                                <label for="">Nama Kavling</label>
                                <p><b>{{ $data->nama_kavling . ' No ' . $data->no_kavling }}</b></p>
                            </div>
                            <div class="col-md-4 ">
                                <label for="">Tipe Rumah</label>
                                <p><b>{{ $data->nama_tipe }}</b></p>
                            </div>
                            <div class="col-md-4 ">
                                <label for="">Harga Jual</label>
                                <p><b>{{ Helper::price($data->harga_jual) }}</b></p>
                            </div>
                            <div class="col-md-4  ">
                                <label for="">Harga Fix</label>
                                @if ($data->harga_fix == null)
                                    <input type="number" name="harga_fix" class="form-control" value=""
                                        placeholder="Harga Fix">
                                @else
                                    <p><b>{{ Helper::price($data->harga_fix) }}</b>
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-4  ">
                                <label for="">Jumlah ITJ</label>
                                @if ($data->jumlah_itj == null)
                                    <input type="number" name="jumlah_itj" class="form-control" value=""
                                        placeholder="Jumlah ITJ">
                                @else
                                    <p><b>{{ Helper::price($data->jumlah_itj) }}</b>
                                    </p>
                                @endif

                            </div>
                            <div class="col-md-4  ">
                                <label for="">Tanggal ITJ</label>
                                @if ($data->tanggal_itj == null)
                                    <input type="date" name="tanggal_itj" class="form-control" value=""
                                        placeholder="Harga Fix">
                                @else
                                    <p><b>{{ Helper::formatTanggal($data->tanggal_itj) }}</b>
                                    </p>
                                @endif

                            </div>
                            <div class="col-md-4 mt-3 ">
                                <label for="">Metode Bayar</label>
                                @if ($data->harga_fix == null)
                                    <select name="metode_bayar" class="form-control" id="">
                                        <option value="">Pilih Metode Bayar</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Kredit">Kredit</option>
                                    </select>
                                @else
                                    <p><b>{{ $data->metode_bayar }}</b>
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-4 mt-3 ">
                                <label for="">Jumlah Angsuran</label>
                                @if ($data->jumlah_angsuran == null)
                                    <input type="number" name="jumlah_angsuran" class="form-control" value=""
                                        placeholder="Jumlah Angsuran">
                                @else
                                    <p><b>{{ $data->jumlah_angsuran }}</b>
                                    </p>
                                @endif

                            </div>
                            <div class="col-md-4 mt-3 ">
                                <label for="">Besar Angsuran</label>
                                @if ($data->besar_angsuran == null)
                                    <input type="number" name="besar_angsuran" class="form-control" value=""
                                        placeholder="Besar Angsuran">
                                @else
                                <p><b>{{ Helper::price($data->besar_angsuran) }}</b>
                                </p>
                                @endif

                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">Status Pembelian</label>
                                <select name="status" class="form-control" id="">
                                    <option value="">Pilih status</option>
                                    <option value="Masuk" {{$data->status == 'Masuk' ? 'selected' : ''}}>Masuk</option>
                                    <option value="Lunas" {{$data->status == 'Lunas' ? 'selected' : ''}}>Lunas</option>
                                    <option value="Angsuran" {{$data->status == 'Angsuran' ? 'selected' : ''}}>Angsuran</option>
                                    <option value="Batal" {{$data->status == 'Batal' ? 'selected' : ''}}>Batal</option>
                                </select>
                            </div>
                            <div class="col-lg-12 text-right">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

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



@endsection
