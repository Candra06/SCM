
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
<form action="/dashboard/tiperumah/data" enctype="multipart/form-data" method="POST">

    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tipe Rumah</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <select class="form-control @error('kavling') is-invalid @enderror" name="kavling">
                                    <option value="">Pilih Kavling</option>
                                    @foreach ($kavling as $item)
                                        <option value="{{$item->id}}" {{old('kavling') == $item->id ? 'selected' : ''}}>{{$item->nama_kavling}}</option>
                                    @endforeach

                                </select>
                                @error('kavling')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <input type="text" name="nama_tipe" value="{{old('nama_tipe')}}" class="form-control @error('nama_tipe') is-invalid @enderror" placeholder="Nama Tipe">
                            @error('nama_tipe')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <input type="number" min="1" name="panjang_tanah" value="{{old('panjang_tanah')}}" class="form-control @error('panjang_tanah') is-invalid @enderror" placeholder="Panjang Tanah (meter)">
                            @error('panjang_tanah')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <input type="number" min="1" name="lebar_tanah" value="{{old('lebar_tanah')}}" class="form-control @error('lebar_tanah') is-invalid @enderror" placeholder="Lebar Tanah (meter)">
                            @error('lebar_tanah')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <input type="number" min="1" name="panjang_bangunan" value="{{old('panjang_bangunan')}}" class="form-control @error('panjang_bangunan') is-invalid @enderror" placeholder="Panjang Bangunan (meter)">
                            @error('panjang_bangunan')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <input type="number" min="1" name="lebar_bangunan" value="{{old('lebar_bangunan')}}" class="form-control @error('lebar_bangunan') is-invalid @enderror" placeholder="Lebat Bangunan (meter)">
                            @error('lebar_bangunan')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div> <div class="col-lg-4 mb-3">
                            <input type="number" min="1" name="jumlah_lantai" value="{{old('jumlah_lantai')}}" class="form-control @error('jumlah_lantai') is-invalid @enderror" placeholder="Jumlah Lantai">
                            @error('jumlah_lantai')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <input type="number" min="1" name="harga_jual" value="{{old('harga_jual')}}" class="form-control @error('harga_jual') is-invalid @enderror" placeholder="Harga Jual">
                            @error('harga_jual')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <select class="form-control @error('status') is-invalid @enderror" name="status">
                                    <option value="">Select Status</option>
                                    <option value="Ready" {{old('status') == 'Ready' ? 'selected' : ''}}>Ready</option>
                                    <option value="Sold Out" {{old('status') == 'Sold Out' ? 'selected' : ''}}>Sold Out</option>
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
                                <label for="">Desain Rumah</label>
                                <input type="file" id="input-file-now" name="desain_rumah" class="dropify" />
                                @error('desain_rumah')
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
