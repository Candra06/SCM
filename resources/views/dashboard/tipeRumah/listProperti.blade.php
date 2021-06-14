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

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Tipe Rumah dan Kavling</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($data as $item)
                            <div class="col-md-4">
                                <div class="card">
                                    <img class="card-img-top" src="{{asset("storage/desain/".$item->desain_rumah)}}" alt=""
                                        style="width: 100%; height: 100%; object-fit: cover;">

                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->nama_kavling . ' ' . $item->no_kavling }}</h5>
                                        <div style="float:right;">
                                            <label for="">Jumlah Lantai</label>
                                         <p style="text-align:right;"  class="card-text"><b>{{ $item->jumlah_lantai }}</b></p>
                                         </div>
                                        <div style="text-align:left;">

                                           <label for=""> Tipe Rumah</label>
                                            <p class="card-text"><b>{{ $item->nama_tipe }}</b></p>
                                        </div>
                                        <label for="">Harga Jual</label>
                                        <p class="card-text"><b>{{ Helper::price($item->harga_jual) }}</b></p>
                                        <a href="{{ url('/dashboard/properti/detail/' . $item->id) }}"
                                            class="btn btn-block btn-primary">Detail</a>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
