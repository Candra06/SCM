<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Kontraktor;
use App\Pembelian;
use App\ProgresProyek;
use App\Proyek;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class ProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Proyek::leftJoin('pembelian', 'pembelian.id', 'proyek.id_pembelian')
            ->leftJoin('tipe_rumah', 'tipe_rumah.id', 'pembelian.id_tipe')
            ->leftJoin('kavling', 'kavling.id', 'tipe_rumah.id_kavling')
            ->leftJoin('pelanggan', 'pelanggan.id', 'pembelian.id_pelanggan')
            ->select('pelanggan.nama', 'kavling.nama_kavling', 'kavling.no_kavling', 'tipe_rumah.nama_tipe', 'proyek.*')
            ->get();
        return view('dashboard.proyek.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kontraktor = Kontraktor::where('status', 'Aktif')->get();
        $proyek = Pembelian::leftJoin('tipe_rumah', 'tipe_rumah.id', 'pembelian.id_tipe')
            ->leftJoin('kavling', 'kavling.id', 'tipe_rumah.id_kavling')
            ->select('pembelian.*', 'tipe_rumah.nama_tipe', 'kavling.nama_kavling', 'kavling.no_kavling')
            ->get();

        return view('dashboard.proyek.add', compact('kontraktor', 'proyek'));
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
            'kontraktor' => 'required',
            'proyek' => 'required',
            'target_selesai' => 'required',
        ]);
        try {
            Proyek::create([
                'id_pembelian' => $request->proyek,
                'id_kontraktor' => $request->kontraktor,
                'target_selesai' => $request->target_selesai,
            ]);
            return redirect('/dashboard/proyek/data')->with('status', 'Berhasil menambahkan proyek');
        } catch (\Throwable $th) {
            return redirect('/dashboard/proyek/data/create')->with('status', 'Gagal menambahkan proyek');
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
        $data = Proyek::leftJoin('pembelian', 'pembelian.id', 'proyek.id_pembelian')
            ->leftJoin('tipe_rumah', 'tipe_rumah.id', 'pembelian.id_tipe')
            ->leftJoin('kavling', 'kavling.id', 'tipe_rumah.id_kavling')
            ->leftJoin('kontraktor', 'kontraktor.id', 'proyek.id_kontraktor')
            ->leftJoin('pelanggan', 'pelanggan.id', 'pembelian.id_pelanggan')
            ->select('pelanggan.nama', 'pembelian.id', 'kavling.nama_kavling', 'kavling.no_kavling', 'tipe_rumah.nama_tipe', 'proyek.*', 'kontraktor.nama as nama_kontraktor', 'kontraktor.telepon as telepon_kontraktor')
            ->where('proyek.id', $id)
            ->first();
        $progres = ProgresProyek::where('id_proyek', $id)->get();
        // return $data;
        return view('dashboard.proyek.detailProyek', compact('data', 'progres'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Proyek::leftJoin('pembelian', 'pembelian.id', 'proyek.id_pembelian')
            ->leftJoin('tipe_rumah', 'tipe_rumah.id', 'pembelian.id_tipe')
            ->leftJoin('kavling', 'kavling.id', 'tipe_rumah.id_kavling')
            ->select('pembelian.id', 'kavling.nama_kavling', 'kavling.no_kavling', 'tipe_rumah.nama_tipe', 'proyek.*')
            ->where('proyek.id', $id)
            ->first();
        $kontraktor = Kontraktor::where('status', 'Aktif')->get();
        $proyek = Pembelian::leftJoin('tipe_rumah', 'tipe_rumah.id', 'pembelian.id_tipe')
            ->leftJoin('kavling', 'kavling.id', 'tipe_rumah.id_kavling')
            ->select('pembelian.*', 'tipe_rumah.nama_tipe', 'kavling.nama_kavling', 'kavling.no_kavling')
            ->get();
        return view('dashboard.proyek.edit', compact('data', 'kontraktor', 'proyek'));
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
            'kontraktor' => 'required',
            'proyek' => 'required',
            'target_selesai' => 'required',
        ]);
        try {
            Proyek::where('id', $id)->update([
                'id_pembelian' => $request->proyek,
                'id_kontraktor' => $request->kontraktor,
                'target_selesai' => $request->target_selesai,
            ]);
            return redirect('/dashboard/proyek/data')->with('status', 'Berhasil mengubah proyek');
        } catch (\Throwable $th) {
            return redirect('/dashboard/proyek/data/' . $id . '/edit')->with('status', 'Gagal mengubah proyek');
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
