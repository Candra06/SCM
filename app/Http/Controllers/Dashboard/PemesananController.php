<?php

namespace App\Http\Controllers\Dashboard;

use App\Angsurann;
use App\Http\Controllers\Controller;
use App\Kavling;
use App\Pembelian;
use App\Tipe;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pembelian::leftJoin('pelanggan', 'pelanggan.id', 'pembelian.id_pelanggan')
            ->leftJoin('tipe_rumah', 'tipe_rumah.id', 'pembelian.id_tipe')
            ->leftJoin('kavling', 'kavling.id', 'tipe_rumah.id_kavling')
            ->select('pembelian.*', 'tipe_rumah.nama_tipe', 'tipe_rumah.harga_jual', 'kavling.nama_kavling', 'kavling.no_kavling', 'pelanggan.nama')
            ->get();
        return view('dashboard.pembelian.data', compact('data'));
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
        $data = Pembelian::leftJoin('tipe_rumah', 'tipe_rumah.id', 'pembelian.id_tipe')
            ->leftJoin('kavling', 'kavling.id', 'tipe_rumah.id_kavling')
            ->select('pembelian.*', 'tipe_rumah.nama_tipe', 'kavling.nama_kavling', 'kavling.no_kavling', 'tipe_rumah.harga_jual')
            ->where('pembelian.id', $id)
            ->first();
        $angsuran = Angsurann::where('id_pembelian', $id)->orderBy('id', 'ASC')->get();
        return view('dashboard.pembelian.detailPenjualan', compact('data', 'angsuran'));
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
        // return $request;
        $pb = Pembelian::where('id', $id)->first();
        $update = [];
        $tipe = Tipe::where('id', $pb->id_tipe)->first();
        $kavling = Kavling::where('id', $tipe->id_kavling)->first();
        if ($pb->status == 'Masuk') {
            $update['harga_fix'] = $request->harga_fix;
            $update['jumlah_itj'] = $request->jumlah_itj;
            $update['tanggal_itj'] = $request->tanggal_itj;
            $update['metode_bayar'] = $request->metode_bayar;
            $update['jumlah_angsuran'] = $request->jumlah_angsuran;
            $update['besar_angsuran'] = $request->besar_angsuran;
            $update['status'] = $request->status;
        } else {
            $update['status'] = $request->status;
        }

        try {
            Pembelian::where('id', $id)->update($update);
            $tipe = Tipe::where('id', $pb->id_tipe)->first();
            $kavling = Kavling::where('id', $tipe->id_kavling)->first();
            Kavling::where('id', $tipe->id_kavling)->update(['status' => 'Sold Out']);
            Tipe::where('id',  $pb->id_tipe)->update(['status' => 'Sold Out']);
            return redirect('/dashboard/pemesanan/data')->with('status', 'Berhasil memverifikasi pembelian');
        } catch (\Throwable $th) {
            return redirect('/dashboard/pemesanan/data/' . $id . '/edit')->with('status', 'Gagal memverifikasi pembelian');
        }
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
