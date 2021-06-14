<?php

namespace App\Http\Controllers\Dashboard;

use App\Barang;
use App\DetailPembelianBarang;
use App\Http\Controllers\Controller;
use App\Kontraktor;
use App\Pembelian;
use App\PembelianBarang;
use App\ProgresPembelian;
use App\Supplier;
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
        // if (condition) {
        //     # code...
        // }

        if (Auth::user()->role_id == '2') {
            $data = DetailPembelianBarang::leftJoin('pembelian_barang', 'pembelian_barang.id', 'detail_pembelian_barang.id_pembelian')
                ->leftJoin('barang', 'barang.id', 'detail_pembelian_barang.id_barang')
                ->leftJoin('supplier', 'supplier.id', 'pembelian_barang.id_supplier')
                ->select('barang.nama_barang', 'barang.harga', 'detail_pembelian_barang.*', 'supplier.nama', 'pembelian_barang.status')
                ->get();
            // return $data;
            return view('dashboard.pembelian.listPembelianMaterial', compact('data'));
        } else if (Auth::user()->role_id == '4') {
            $id = Supplier::where('id_akun', Auth::user()->id)->first();
            $data = DetailPembelianBarang::leftJoin('pembelian_barang', 'pembelian_barang.id', 'detail_pembelian_barang.id_pembelian')
                ->leftJoin('barang', 'barang.id', 'detail_pembelian_barang.id_barang')
                ->leftJoin('supplier', 'supplier.id', 'pembelian_barang.id_supplier')
                ->select('barang.nama_barang', 'barang.harga', 'detail_pembelian_barang.*', 'supplier.nama', 'pembelian_barang.status')
                ->where('pembelian_barang.id_supplier', $id->id)
                ->get();
        } else {
            $id = Kontraktor::where('id_akun', Auth::user()->id)->first();
            $data = DetailPembelianBarang::leftJoin('pembelian_barang', 'pembelian_barang.id', 'detail_pembelian_barang.id_pembelian')
                ->leftJoin('barang', 'barang.id', 'detail_pembelian_barang.id_barang')
                ->leftJoin('supplier', 'supplier.id', 'pembelian_barang.id_supplier')
                ->select('barang.nama_barang', 'barang.harga', 'detail_pembelian_barang.*', 'supplier.nama', 'pembelian_barang.status')
                ->where('pembelian_barang.id_kontraktor', $id->id)
                ->get();
            // return $data;
            return view('dashboard.pembelian.listPembelianMaterial', compact('data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Barang::leftJoin('supplier', 'supplier.id', 'barang.id_supplier')
            ->select('barang.*', 'supplier.nama', 'supplier.id as id_sup')
            ->where('barang.status', 'Ready')
            ->get();
        // return $data;
        return view('dashboard.dataBarang.listBarang', compact('data'));
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
            ProgresPembelian::create([
                'id_pembelian' => $beli->id,
                'keterangan' => Auth::user()->name . ' menambahkan pembelian baru',
                'created_by' => Auth::user()->id,
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
        $data = DetailPembelianBarang::leftJoin('pembelian_barang', 'pembelian_barang.id', 'detail_pembelian_barang.id_pembelian')
            ->leftJoin('barang', 'barang.id', 'detail_pembelian_barang.id_barang')
            ->leftJoin('supplier', 'supplier.id', 'pembelian_barang.id_supplier')
            ->select('barang.nama_barang', 'barang.harga', 'barang.satuan', 'detail_pembelian_barang.*', 'supplier.nama', 'pembelian_barang.status', 'pembelian_barang.metode_bayar')
            ->where('detail_pembelian_barang.id', $id)
            ->first();
        $progres = ProgresPembelian::where('id_pembelian', $data->id_pembelian)->orderBy('id', 'DESC')->get();
        // return $data;
        return view('dashboard.pembelian.detailPembMaterialKontraktor', compact('data', 'progres'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        try {
            PembelianBarang::where('id', $id)->update([
                'status' => $request->status
            ]);
            ProgresPembelian::create([
                'id_pembelian' => $id,
                'keterangan' => Auth::user()->name . ' membatalkan pemesanan material.',
                'created_by' => Auth::user()->id,
            ]);
            return redirect('/dashboard/material/data')->with('status', 'Berhasil membatalkan pemesanan');
        } catch (\Throwable $th) {
            throw $th;
        }
        return $request;
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
