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
                    <h6 class="m-0 font-weight-bold text-primary">Data Pembelian</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Material</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th>Supplier</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $m)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $m->nama_barang}}</td>
                                        <td>{{ Helper::price($m->harga)  }}</td>
                                        <td>{{ $m->jumlah }}</td>
                                        <td>{{ Helper::price($m->sub_total)  }}</td>
                                        <td>{{ $m->nama }}</td>
                                        <td>{{ $m->status }}</td>

                                        <td class="justify-content-center">
                                            <a href="{{ '/dashboard/material/data/' . $m->id_pembelian }}"
                                                class="btn btn-sm btn-primary btn-circle mr-2">
                                                <i data-feather="eye"></i>
                                            </a>
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
