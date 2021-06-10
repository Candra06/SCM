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
                                    <th>Kavling</th>
                                    <th>Tipe</th>
                                    <th>Harga Kavling</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $m)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $m->nama_kavling . ' No ' . $m->no_kavling }}</td>
                                        <td>{{ $m->nama_tipe }}</td>
                                        <td>{{ Helper::price($m->harga_jual) }}</td>
                                        <td>
                                            @if ($m->status == 'Masuk')
                                                <span class="badge badge-warning">Masuk</span>
                                            @elseif ($m->status == 'Lunas')
                                                <span class="badge badge-success">Lunas</span>
                                            @elseif ($m->status == 'Angsuran')
                                                <span class="badge badge-primary">Angsuran</span>
                                            @elseif ($m->status == 'Batal')
                                                <span class="badge badge-danger">Batal</span>
                                            @endif
                                        </td>
                                        <td class="justify-content-center">
                                            <a href="{{ '/dashboard/pembelian/pelanggan/' . $m->id }}"
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
