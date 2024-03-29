<?php

namespace App\Http\Controllers\Dashboard;

use App\Barang;
use App\DetailPembelianBarang;
use App\Http\Controllers\Controller;
use App\PembelianBarang;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $supplier = Supplier::where("id_akun", $user)->first();
        $data = DetailPembelianBarang::leftjoin("pembelian_barang", "pembelian_barang.id", "detail_pembelian_barang.id_pembelian")
            ->leftjoin("kontraktor", "kontraktor.id", "pembelian_barang.id_kontraktor")
            ->leftjoin("supplier", "supplier.id", "pembelian_barang.id_supplier")
            ->leftjoin("barang", "barang.id", "detail_pembelian_barang.id_barang")
            ->where("pembelian_barang.id_supplier", $supplier->id)
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
        var_dump("store");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DetailPembelianBarang::leftjoin("pembelian_barang", "pembelian_barang.id", "detail_pembelian_barang.id_pembelian")
            ->leftjoin("kontraktor", "kontraktor.id", "pembelian_barang.id_kontraktor")
            ->leftjoin("supplier", "supplier.id", "pembelian_barang.id_supplier")
            ->leftjoin("barang", "barang.id", "detail_pembelian_barang.id_barang")
            ->where("detail_pembelian_barang.id", $id)
            ->select("kontraktor.nama", "barang.nama_barang", "barang.satuan", "pembelian_barang.status", "pembelian_barang.metode_bayar", "detail_pembelian_barang.*")
            ->first();

        $progres = DB::table("progres_pembelian")
            ->where("id_pembelian", $id)
            ->select("progres_pembelian.*")
            ->get();
        // return $data;
        return view('dashboard.data_pemesanan_barang.detailProyek', compact('data', 'progres', "id"));
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
        $user = Auth::user()->id;
        $request->validate([
            'progres_pembelian_barang_id' => 'required',
            'status' => 'required',
            //            'date' => 'required',
        ]);
        $data = PembelianBarang::leftjoin("detail_pembelian_barang", "detail_pembelian_barang.id_pembelian", "pembelian_barang.id")
            ->leftjoin("barang", "barang.id", "detail_pembelian_barang.id_barang")
            ->where("pembelian_barang.id", $id)
            ->select("detail_pembelian_barang.jumlah", "detail_pembelian_barang.id_barang", "barang.stok")
            ->first();

        $newstock = $data->stok + $data->jumlah;
        try {
            PembelianBarang::where("id", $id)->update([
                "status" => $request->status
            ]);

            if ($request->status == 'Batal') {
                Barang::where("id", $data->id_barang)->update([
                    "stok" => $newstock
                ]);
            }

            DB::table("progres_pembelian")->insert([
                "id_pembelian" => $id,
                "keterangan" => "Diubah oleh Supplier dengan status : " . $request->status,
                "created_by" => $user,
                "created_at" => date('y-m-d H:i:s'),
            ]);
            return redirect("/dashboard/data-pemesanan-barang/data")->with('status', 'Berhasil menambahkan proyek');
        } catch (\Throwable $th) {
            return redirect("/dashboard/data-pemesanan-barang/data")->with('status', 'Gagal menambahkan proyek');
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
