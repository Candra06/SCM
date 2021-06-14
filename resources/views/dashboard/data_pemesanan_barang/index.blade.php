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
                    <h6 class="m-0 font-weight-bold text-primary">Data Pemesanan Barang</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kontraktor</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Status</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama}}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ $item->satuan}}</td>
                                    <td>
                                        @if($item->status == "Lunas")
                                            <span class="badge badge-success">Lunas</span>
                                        @elseif($item->status == "Pending")
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($item->status == "Diproses")
                                            <span class="badge badge-primary">Diproses</span>
                                        @elseif($item->status == "Dikirim")
                                            <span class="badge badge-info">Diproses</span>
                                        @else
                                            <span class="badge badge-danger">Batal</span>
                                        @endif
                                    </td>
                                    <td class="justify-content-center">
                                        @if (Helper::permission()->edit == 1)
                                            <a href="{{ Helper::permission()->url . '/' . $item->id . '/edit' }}"
                                                class="btn btn-sm btn-primary btn-circle mr-2">
                                                <i data-feather="edit-2"></i>
                                            </a>
                                        @endif
                                        <a href="{{ url('/dashboard/data-pemesanan-barang/data/'.$item->id) }}"
                                            class="btn btn-sm btn-secondary btn-circle mr-2">
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
@endsection
