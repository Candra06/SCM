<?php

namespace App\Http\Controllers\Dashboard;

use App\Barang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DataBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->id;
        $supplier = DB::table("supplier")->where("id_akun", $user)->first();
        $databarang = DB::table("barang")->where("id_supplier", $supplier->id)->paginate(10);
        return view("dashboard.dataBarang.index", compact("databarang"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.dataBarang.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $supplier_id = DB::table("supplier")->where("id_akun", $user_id)->first();

        $request->validate([
            "nama_barang" => "required",
            "deskripsi_barang" => "required",
            "satuan_barang" => "required",
            "stok" => "required|numeric",
            "harga_jual" => "required|numeric",
            "status" => "required",
            'gambar_barang' => 'file|between:0,2048|mimes:png,jpg,jpeg',
        ]);

        $fileType = $request->file('gambar_barang')->extension();
        $name = Str::random(8) . '.' . $fileType;
        Storage::putFileAs('public/barang', $request->file('gambar_barang'), $name);

        $input["id_supplier"] = $supplier_id->id;
        $input["nama_barang"] = $request["nama_barang"];
        $input["deskripsi"] = $request["deskripsi_barang"];
        $input["satuan"] = $request["satuan_barang"];
        $input["stok"] = $request["stok"];
        $input["harga"] = $request["harga_jual"];
        $input["status"] = $request["status"];
        $input['gambar'] = $name;

        try {
            Barang::create($input);
            return redirect('/dashboard/databarang/data')->with('status', 'Berhasil menambah data');
        } catch (\Throwable $th) {
            return redirect('/dashboard/databarang/data/create')->with('status', 'Gagal menambah data');
        }
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
        $databarang = DB::table("barang")->where("id", $id)->first();
        return view('dashboard.dataBarang.edit', compact("databarang"));
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
        $request->validate([
            "editnama_barang" => "required",
            "editdeskripsi_barang" => "required",
            "editsatuan_barang" => "required",
            "editstok" => "required|numeric",
            "editharga_jual" => "required|numeric",
            "editstatus" => "required",
            'editgambar_barang' => 'file|between:0,2048|mimes:png,jpg,jpeg',
        ]);
//        dd($request['editgambar_barang']);



        if ($request['editgambar_barang'] != null){
            $fileType = $request->file('editgambar_barang')->extension();
            $name = Str::random(8) . '.' . $fileType;
            Storage::putFileAs('public/barang', $request->file('gambar_barang'), $name);
            $input['gambar'] = $name;
        }

        $input["nama_barang"] = $request["editnama_barang"];
        $input["deskripsi"] = $request["editdeskripsi_barang"];
        $input["satuan"] = $request["editsatuan_barang"];
        $input["stok"] = $request["editstok"];
        $input["harga"] = $request["editharga_jual"];
        $input["status"] = $request["editstatus"];


        try {
//            dd($input);
            Barang::where("id", $id)->update($input);
            return redirect('/dashboard/databarang/data')->with('status', 'Berhasil Mengubah data');
        }catch (\Throwable $th){
            return redirect('/dashboard/databarang/data')->with('status', 'Gagal Mengubah data');
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
        try {
            Barang::where("id", $id)->delete();
            return redirect('/dashboard/databarang/data')->with('status', 'Berhasil Menghapus data');
        }catch (\Throwable $th){
            return redirect('/dashboard/databarang/data')->with('status', 'Gagal Menghapus data');
        }
    }
}
