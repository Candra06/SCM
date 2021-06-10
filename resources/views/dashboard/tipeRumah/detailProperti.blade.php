@extends('dashboard.templates.master')
@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Kavling</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <img class="card-img-top" src="{{ asset($data->desain_rumah) }}" alt=""
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Nama Kavling</label>
                            <p><b>{{ $data->nama_kavling . ' No ' . $data->no_kavling }}</b></p>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Tipe Rumah</label>
                            <p><b>{{ $data->nama_tipe }}</b></p>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Jumlah Lantai</label>
                            <p><b>{{ $data->jumlah_lantai }}</b></p>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Panjang Tanah</label>
                            <p><b>{{ $data->panjang_tanah }} meter</b></p>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Lebar Tanah</label>
                            <p><b>{{ $data->lebar_tanah }} meter</b></p>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Panjang Bangunan</label>
                            <p><b>{{ $data->panjang_bangunan }} meter</b></p>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Lebar Bangunan</label>
                            <p><b>{{ $data->lebar_bangunan }} meter</b></p>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Harga Jual</label>
                            <p><b>{{ Helper::price($data->harga_jual) }}</b></p>
                        </div>
                        <div class="col-md-4 ">
                            <label for="">Status</label>
                            <p><b>{{ $data->status }}</b></p>
                        </div>
                        <div class="col-md-12 mt-4">
                            <form action="{{ url('/dashboard/properti/pembelian') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_tipe" value="{{ $data->id }}">
                                <button type="submit" class="btn btn-block btn-lg btn-primary">Beli Sekarang</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
