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
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Material</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($data as $item)
                            <div class="col-md-4">
                                <div class="card">
                                    <img class="card-img-top" src="{{url('/'.$item->gambar)}}" alt=""

                                        style="width: 100%; height: 100%; object-fit: cover;">

                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->nama_barang }}</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="">Stok</label>
                                                <p   class="card-text"><b>{{ $item->stok .' '.$item->satuan }}</b></p>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <label for="">Supplier</label>
                                                <p class="card-text"><b>{{ $item->nama }}</b></p>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="">Harga</label>
                                                <p class="card-text"><b>{{ Helper::price($item->harga) }}</b></p>
                                            </div>

                                            <div class="col-md-6 text-right mt-2">
                                                <label for="">Status</label>
                                                <p class="card-text"><b>{{ $item->status }}</b></p>
                                            </div>

                                        </div>
                                        @if($item->stok == 0)
                                            <button disabled class="btn btn-block btn-danger mt-4">Out Of Stock</button>
                                        @else
                                            <button data-toggle="modal" data-target="#exampleModalLong" class="btn btn-block btn-primary mt-4">Order</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- modal pembelian --}}
                            <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <form action="{{ url('/dashboard/material/data')}}" method="post" class="form-group">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">Form Pemesanan</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">

                                        @csrf
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <label for="">Metode Bayar</label>
                                                  <select name="metode" class="form-control" id="" required>
                                                      <option value="">Pilih Metode Pembayaran</option>
                                                      <option value="Cash">Cash</option>
                                                      <option value="Credit">Credit</option>
                                                  </select>
                                              </div>
                                              <div class="col-md-12 mt-3">
                                                <label for="">Jumlah</label>
                                                <input type="hidden" name="id_barang" value="{{$item->id}}" id="">
                                                <input type="hidden" name="id_sup" value="{{$item->id_sup}}" id="">
                                                <input type="hidden" name="harga" id="harga" value="{{$item->harga}}" id="">
                                                <input type="number" id="jumlah" required name="jumlah" class="form-control" id="jumlah" placeholder="Jumlah Pembelian" min="1" max="{{__($item->stok)}}">
                                              </div>
                                              <div class="col-md-12 mt-3">
                                                  <label for="">Total</label>
                                                  <h5 id="total">{{Helper::price(0)}}</h5>
                                              </div>
                                              <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

                                              <script type="text/javascript">
                                                  $("#jumlah").on('keyup', function() {
                                                        var t = document.getElementById('jumlah').value;
                                                        var c = document.getElementById('harga').value;
                                                        var ttl = c *  t;
                                                        var format = formatRupiah(ttl, 'Rp.')
                                                        $('#total:last').text( format);
                                                    });
                                                    function formatRupiah(angka, prefix){
                                                        var	number_string = String(angka),
                                                        split   		= number_string.split(','),
                                                            sisa 	= number_string.length % 3,
                                                            rupiah 	= number_string.substr(0, sisa),
                                                            ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
                                                        if (ribuan) {
                                                            separator = sisa ? '.' : '';
                                                            rupiah += separator + ribuan.join('.');
                                                        }

                                                        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                                                        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
                                                    }
                                              </script>
                                          </div>

                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="sumbit" class="btn btn-primary">Save changes</button>
                                    </div>
                                    </form>
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
