<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datasupplier = User::whereNotIn('id', [1])->where("role_id", 4)->get();
        return view("dashboard.supplier.index", compact("datasupplier"));
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
        $request->validate([
            "id_akun" => "required",
            "nama_supplier" => "required",
            "telepon" => "required",
            "alamat_supplier" => "required",
            "status" => "required"
        ]);

        $input["id_akun"] = $request["id_akun"];
        $input["nama"] = $request["nama_supplier"];
        $input["telepon"] = $request["telepon"];
        $input["alamat"] = $request["alamat_supplier"];
        $input["status"] = $request["status"];

        try {
//            Supplier::create($input);
            DB::table("supplier")->insert($input);
            return redirect('/dashboard/supplier/data')->with('status', 'Berhasil menambah data');
        } catch (\Throwable $th) {
//            DB::table("supplier")->insert($input);
            return redirect('/dashboard/supplier/data')->with('status', 'Gagal menambah data');
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
        $datasupplier = $id;
        return view('dashboard.supplier.edit', compact("datasupplier"));
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
            "id_akun" => "required",
            "nama_supplier" => "required",
            "telepon" => "required",
            "alamat_supplier" => "required",
            "status" => "required"
        ]);

        $input["id_akun"] = $request["id_akun"];
        $input["nama"] = $request["nama_supplier"];
        $input["telepon"] = $request["telepon"];
        $input["alamat"] = $request["alamat_supplier"];
        $input["status"] = $request["status"];

        try {
            Supplier::create($input);
            return redirect('/dashboard/supplier/data')->with('status', 'Berhasil menambah data');
        } catch (\Throwable $th) {
            return redirect('/dashboard/supplier/data')->with('status', 'Gagal menambah data');
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
