<?php

namespace App\Http\Controllers\Dashboard;

use App\Pelanggan;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pelanggan::all();
        // return $data;
        return view('dashboard.pelanggan.index', compact('data'));
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
       $data = Pelanggan::where('id', $id)->first();
    //    return $data;
       return view('dashboard.pelanggan.detail', compact('data'));
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
        $request->validate([
            "nama" => "required",
            "nik" => "required",
            "telepon" => "required",
            "profesi" => "required",
            "alamat_domisili" => "required",
            "alamat_ktp" => "required",
            "instansi" => "required",
            "tlpn_instansi" => "required",
            "alamat_instansi" => "required",
            "email" => "required"
        ]);
        if ($request["password"] != null){
            $input["password"] = $request["password"];
        }
        $data = Pelanggan::where('id_akun', Auth::user()->id)->first();

        $idpelanggan = Pelanggan::where("id_akun", $id)->first();

        $input["name"] = $request["nama"];
        $input["email"] = $request["email"];
        $input1["nama"] = $request["nama"];
        $input1["nik"] = $request["nik"];
        $input1["telepon"] = $request["telepon"];
        $input1["profesi"] = $request["profesi"];
        $input1["instansi"] = $request["instansi"];
        $input1["alamat_instansi"] = $request["alamat_instansi"];
        $input1["tlpn_instansi"] = $request["tlpn_instansi"];
        $input1["alamat_domisili"] = $request["alamat_domisili"];
        $input1["alamat_ktp"] = $request["alamat_ktp"];

        try {
            User::where("id", $id)->update($input);
            Pelanggan::where("id", $idpelanggan->id)->update($input1);
            return view('dashboard.home.homePelanggan', compact('data'));
        }catch (\Throwable $th){
            return view('dashboard.home.homePelanggan', compact('data'));
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
