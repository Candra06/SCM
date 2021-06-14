<?php

namespace App\Http\Controllers\Dashboard;

use App\Barang;
use App\DetailPembelianBarang;
use App\Http\Controllers\Controller;
use App\Kontraktor;
use App\Pembelian;
use App\PembelianBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembelianMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Barang::leftJoin('supplier', 'supplier.id', 'barang.id_supplier')
                ->select('barang.*', 'supplier.nama', 'supplier.id as id_sup')
                ->where('barang.status', 'Ready')
                ->get();
                // return $data;
        return view('dashboard.dataBarang.listBarang', compact('data'));
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
        try {
            $id = Kontraktor::where('id_akun', Auth::user()->id)->select('id')->first();
            $total = $request->harga * $request->jumlah;
            // return $total;
            $beli = PembelianBarang::create([
                'id_kontraktor' => $id->id,
                'id_supplier' => $request->id_sup,
                'status' => 'Pending',
                'metode_bayar' => $request->metode,
                'total' => $total,
            ]);
            DetailPembelianBarang::create([
                'id_pembelian' => $beli->id,
                'id_barang' => $request->id_barang,
                'jumlah' => $request->jumlah,
                'sub_total' => $total,
            ]);
            return redirect('/dashboard/material/data')->with('status', 'Berhasil melakukan pemesanan');
        } catch (\Throwable $th) {
            throw $th;
            return redirect('/dashboard/material/data')->with('status', 'Gagal melakukan pemesanan');
        }
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
