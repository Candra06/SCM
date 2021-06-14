<?php

namespace App\Http\Controllers\Dashboard;

use App\Angsurann;
use App\Http\Controllers\Controller;
use App\Pelanggan;
use App\Pembelian;
use App\ProgresProyek;
use App\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use App\Helpers;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Pelanggan::where('id_akun', Auth::user()->id)->first();
        $data = Pembelian::leftJoin('tipe_rumah', 'tipe_rumah.id', 'pembelian.id_tipe')
            ->leftJoin('kavling', 'kavling.id', 'tipe_rumah.id_kavling')
            ->where('pembelian.id_pelanggan', $id->id)
            ->select('pembelian.*', 'tipe_rumah.nama_tipe', 'kavling.nama_kavling', 'kavling.no_kavling', 'tipe_rumah.harga_jual')
            ->get();
        return view('dashboard.pembelian.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            $id = Pelanggan::where('id_akun', Auth::user()->id)->first();
            Pembelian::create([
                'id_pelanggan' => $id->id,
                'id_tipe' => $request->id_tipe,
                'status' => 'Masuk',
                'created_at' => Date('Y-m-d H:i:s'),
                'updated_at' => Date('Y-m-d H:i:s'),
            ]);
            return redirect('/dashboard/properti/detail/' . $request->id_tipe)->with('status', 'Berhasil melakukan booking rumah');
        } catch (\Throwable $th) {
            return redirect('/dashboard/properti/detail/' . $request->id_tipe)->with('error', 'Gagal melakukan booking rumah');
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
        $detailPembelian = Pembelian::leftJoin('tipe_rumah', 'tipe_rumah.id', 'pembelian.id_tipe')
            ->leftJoin('kavling', 'kavling.id', 'tipe_rumah.id_kavling')
            ->select('pembelian.*', 'tipe_rumah.nama_tipe', 'kavling.nama_kavling', 'kavling.no_kavling', 'tipe_rumah.harga_jual')
            ->where('pembelian.id', $id)
            ->first();
        $angsuran = Angsurann::where('id_pembelian', $id)->orderBy('id', 'ASC')->get();
        $detailProyek = Proyek::leftJoin('kontraktor', 'kontraktor.id', 'proyek.id_kontraktor')
            ->where('proyek.id_pembelian', $id)
            ->select('kontraktor.nama', 'kontraktor.telepon', 'proyek.target_selesai')
            ->first();
        $progresProyek = [];
        if (empty($detailProyek)) {
            $progresProyek = [];
        } else {
            $progresProyek = ProgresProyek::where('id_proyek', $detailProyek->id)->orderBy('id', 'DESC')->get();
        }

        return view('dashboard.pembelian.detailPembelian', compact('detailPembelian', 'angsuran', 'detailProyek', 'progresProyek'));
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
