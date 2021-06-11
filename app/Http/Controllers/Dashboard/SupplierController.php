<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Kavling;
use App\Supplier;
use App\Tipe;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        return view("dashboard.supplier.add");

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
            $request->validate([
                "nama_supplier" => "required",
                "telepon" => "required",
                "alamat" => "required",
                "status" => "required",
                "email" => "required",
                "password" => "required",
            ]);

            $input["name"] = $request["nama_supplier"];
            $input["email"] = $request["email"];
            $input['password'] = Hash::make($request['password']);
            $input["role_id"] = 4;
            $id = User::create($input);
            $inputsup["id_akun"] = $id->id;
            $inputsup["nama"] = $request["nama_supplier"];
            $inputsup["telepon"] = $request["telepon"];
            $inputsup["alamat"] = $request["alamat"];
            $inputsup["status"] = $request["status"];
            Supplier::create($inputsup);
            return redirect('/dashboard/supplier/data')->with('status', 'Berhasil menambah data');
        } catch (\Throwable $th) {
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
        $datasupplier = Supplier::where('id_akun', $id)->first();
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
        try {
            $request->validate([
                "editnama_supplier" => "required",
                "edittelepon" => "required",
                "editalamat" => "required",
                "editstatus" => "required",
            ]);

            $datasupplier = Supplier::where('id', $id)->first();

            $input["name"] = $request["editnama_supplier"];
            User::where("id", $datasupplier->id_akun)->update($input);
            $inputsup["nama"] = $request["editnama_supplier"];
            $inputsup["telepon"] = $request["edittelepon"];
            $inputsup["alamat"] = $request["editalamat"];
            $inputsup["status"] = $request["editstatus"];
            Supplier::where("id", $id)->update($inputsup);
            return redirect('/dashboard/supplier/data')->with('status', 'Berhasil Mengubah data');
        }catch (\Throwable $th){
            return redirect('/dashboard/supplier/data')->with('status', 'Gagal Mengubah data');
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
            Supplier::where("id_akun", $id)->delete();
            User::where("id", $id)->delete();
            return redirect('/dashboard/supplier/data')->with('status', 'Berhasil Menghapus data');
        }catch (\Throwable $th){
            return redirect('/dashboard/supplier/data')->with('status', 'Gagal Menghapus data');

        }

    }
}
