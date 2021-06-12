<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\ProgresProyek;
use App\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Progres_ProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->id;
        $data = Proyek::leftjoin("pembelian", "pembelian.id", "proyek.id_pembelian")
            ->leftjoin("tipe_rumah", "tipe_rumah.id", "pembelian.id_tipe")
            ->leftjoin("kavling", "kavling.id", "tipe_rumah.id_kavling")
            ->leftjoin("kontraktor", "kontraktor.id", "proyek.id_kontraktor")
            ->where("kontraktor.id_akun", $user)
            ->select("kavling.nama_kavling", "kavling.no_kavling", "tipe_rumah.nama_tipe", "proyek.*")
            ->get();

//        $data = Proyek::all();
//        dd($data);
        return view('dashboard.progres_proyek.index', compact('data'));

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
            'proyek_id' => 'required',
            'keterangan' => 'required',
            'date' => 'required',
        ]);
        try {
            ProgresProyek::create([
                "id_proyek" => $request->proyek_id,
                "keterangan" => $request->keterangan,
                "tanggal" => $request->date
            ]);
            return redirect("/dashboard/progres-proyek/data")->with('status', 'Berhasil menambahkan proyek');
        }catch (\Throwable $th){
            return redirect("/dashboard/progres-proyek/data")->with('status', 'Gagal menambahkan proyek');
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

        $data = Proyek::leftjoin("pembelian", "pembelian.id", "proyek.id_pembelian")
            ->leftjoin("tipe_rumah", "tipe_rumah.id", "pembelian.id_tipe")
            ->leftjoin("kavling", "kavling.id", "tipe_rumah.id_kavling")
            ->leftjoin("kontraktor", "kontraktor.id", "proyek.id_kontraktor")
            ->where("proyek.id", $id)
            ->select("kontraktor.nama", "kavling.nama_kavling", "kavling.no_kavling", "tipe_rumah.nama_tipe",  "tipe_rumah.jumlah_lantai", "proyek.*")
            ->first();

//        $progres = [];
        $progres = ProgresProyek::where('id_proyek', $id)->get();

        return view('dashboard.progres_proyek.detailProyek', compact('data', 'progres', "id"));
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
