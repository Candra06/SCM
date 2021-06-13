
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
<form action="/dashboard/databarang/data/{{$databarang->id}}" enctype="multipart/form-data" method="POST">
    @method('put')
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Data Barang</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <input type="text" name="editnama_barang" value="{{$databarang->nama_barang}}" class="form-control @error('nama_barang') is-invalid @enderror" placeholder="Nama Barang">
                            @error('nama_barang')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <input type="text" name="editsatuan_barang" value="{{$databarang->satuan}}" class="form-control @error('satuan_barang') is-invalid @enderror" placeholder="Satuan Barang">
                            @error('satuan_barang')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <input type="number" name="editstok" value="{{$databarang->stok}}" class="form-control @error('stok') is-invalid @enderror" placeholder="Stock">
                            @error('stok')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <input type="number" name="editharga_jual" value="{{$databarang->harga}}" class="form-control @error('harga_jual') is-invalid @enderror" placeholder="Harga Jual">
                            @error('harga_jual')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <select class="form-control @error('status') is-invalid @enderror" name="editstatus">
                                    <option value="">Select Status</option>
                                    <option value="Ready" {{$databarang->status == 'Ready' ? 'selected' : ''}}>Ready</option>
                                    <option value="Sold Out" {{$databarang->status == 'Sold Out' ? 'selected' : ''}}>Sold Out</option>
                                </select>
                                @error('url')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label for="">Deskripsi Barang</label>
                                <textarea type="text" name="editdeskripsi_barang" class="form-control @error('deskripsi_barang') is-invalid @enderror" placeholder="Deskripsi Barang">{{__($databarang->deskripsi)}}</textarea>
                                @error('deskripsi_barang')
                                <span class="text-danger mt-2">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label for="">Gambar Barang</label>
                                <input type="file" id="input-file-now" name="editgambar_barang" data-default-file="{{asset("storage/barang/$databarang->gambar")}}" class="dropify" value="{{$databarang->gambar}}" />
                                @error('editgambar_barang')
                                    <span class="text-danger mt-2">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 text-right">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>

@endsection
@push('scripts')
    <script src="{{asset('assets/js/tinymce.min.js')}}"></script>
    <script src="{{asset('assets/js/tinymce.js')}}"></script>
    <script src="{{ asset('assets/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/js/dropify.js') }}"></script>
@endpush
