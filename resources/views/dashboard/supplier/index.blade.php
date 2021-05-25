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
            <h6 class="m-0 font-weight-bold text-primary">Data Kavling</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Kavling</th>
                    <th>Nomor</th>
                    <th>Status</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $m)
                        <tr>
                            <td>{{$loop->iteration}}</td>

                            <td>{{$m->nama_kavling}}</td>
                            <td>{{$m->no_kavling}}</td>
                            <td>{!!$m->status == 'Ready' ? '<span class="badge badge-success">Ready</span>' : '<span class="badge badge-danger">Sold Out</span>'!!}</td>
                            <td class="justify-content-center">
                              @if (Helper::permission()->edit == 1)
                                  <a href="{{Helper::permission()->url . '/' . $m->id . '/edit'}}" class="btn btn-sm btn-primary btn-circle mr-2">
                                      <i data-feather="edit-2"></i>
                                  </a>
                              @endif
                              @if (Helper::permission()->delete)
                                  @php
                                    $linkdelete = Helper::permission()->url . '/' . $m->id
                                  @endphp
                                  <a onclick='modal_konfir("{{ $linkdelete }}")' class="btn btn-sm btn-danger btn-circle mr-2" href="#">
                                    <i data-feather="trash"></i>
                                  </a>
                              @endif
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
