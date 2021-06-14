<?php

namespace App\Http\Controllers\Dashboard;

use App\DetailPembelianBarang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Data_Pemesanan_BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->id;
        $data = DetailPembelianBarang::leftjoin("pembelian_barang", "pembelian_barang.id", "detail_pembelian_barang.id_pembelian")
            ->leftjoin("kontraktor", "kontraktor.id", "pembelian_barang.id_kontraktor")
            ->leftjoin("supplier", "supplier.id", "pembelian_barang.id_supplier")
            ->leftjoin("barang", "barang.id", "detail_pembelian_barang.id_pembelian")
            ->where("supplier.id_akun", $user)
            ->select("kontraktor.nama", "barang.nama_barang", "barang.satuan", "pembelian_barang.status", "detail_pembelian_barang.*")
            ->get();

//        dd($data);
        return view('dashboard.data_pemesanan_barang.index', compact('data'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
