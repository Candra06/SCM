<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kavling;
use App\Tipe;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TipeRumahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Tipe::all();
        return view('dashboard.tipeRumah.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kavling = Kavling::all();
        return view('dashboard.tipeRumah.add', compact('kavling'));
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
            'kavling' => 'required',
            'nama_tipe' => 'required',
            'panjang_tanah' => 'required|numeric',
            'lebar_tanah' => 'required|numeric',
            'panjang_bangunan' => 'required|numeric',
            'lebar_bangunan' => 'required|numeric',
            'jumlah_lantai' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'status' => 'required',
            'desain_rumah' => 'file|between:0,2048|mimes:png,jpg,jpeg',
        ]);

        $fileType = $request->file('desain_rumah')->extension();
        $name = Str::random(8) . '.' . $fileType;
//        $input['desain_rumah'] = Storage::putFileAs('desain', $request->file('desain_rumah'), $name);
        Storage::putFileAs('public/desain', $request->file('desain_rumah'), $name);
        $input['id_kavling'] = $request['kavling'];
        $input['nama_tipe'] = $request['nama_tipe'];
        $input['panjang_bangunan'] = $request['panjang_bangunan'];
        $input['lebar_bangunan'] = $request['lebar_bangunan'];
        $input['panjang_tanah'] = $request['panjang_tanah'];
        $input['lebar_tanah'] = $request['lebar_tanah'];
        $input['jumlah_lantai'] = $request['jumlah_lantai'];
        $input['harga_jual'] = $request['harga_jual'];
        $input['status'] = $request['status'];
        $input['desain_rumah'] = $name;

        try {
            Tipe::create($input);
            return redirect('/dashboard/tiperumah/data')->with('status', 'Berhasil menambah data');
        } catch (\Throwable $th) {
            return redirect('/dashboard/tiperumah/data/create')->with('status', 'Gagal menambah data');
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
        $data = Tipe::where('id', $id)->first();
        $kavling = Kavling::all();
        return view('dashboard.tipeRumah.edit', compact('kavling', 'data'));
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
            'kavling' => 'required',
            'nama_tipe' => 'required',
            'panjang_tanah' => 'required|numeric',
            'lebar_tanah' => 'required|numeric',
            'panjang_bangunan' => 'required|numeric',
            'lebar_bangunan' => 'required|numeric',
            'jumlah_lantai' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'status' => 'required',
            'desain_rumah' => 'file|between:0,2048|mimes:png,jpg,jpeg',
        ]);

        if ($request['desain_rumah']) {
            $fileType = $request->file('desain_rumah')->extension();
            $name = Str::random(8) . '.' . $fileType;
//            $input['desain_rumah'] = Storage::putFileAs('desain', $request->file('desain_rumah'), $name);
            Storage::putFileAs('public/desain', $request->file('desain_rumah'), $name);
            $input['desain_rumah'] = $name;
        }

        $input['id_kavling'] = $request['kavling'];
        $input['nama_tipe'] = $request['nama_tipe'];
        $input['panjang_bangunan'] = $request['panjang_bangunan'];
        $input['lebar_bangunan'] = $request['lebar_bangunan'];
        $input['panjang_tanah'] = $request['panjang_tanah'];
        $input['lebar_tanah'] = $request['lebar_tanah'];
        $input['jumlah_lantai'] = $request['jumlah_lantai'];
        $input['harga_jual'] = $request['harga_jual'];
        $input['status'] = $request['status'];

        try {
            Tipe::where('id', $id)->update($input);
            return redirect('/dashboard/tiperumah/data')->with('status', 'Berhasil mengubah data');
        } catch (\Throwable $th) {
            return redirect('/dashboard/tiperumah/data/' . $id . '/edit')->with('status', 'Gagal mengubah data');
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
            Tipe::where('id', $id)->delete();
            return redirect('/dashboard/tiperumah/data')->with('status', 'Berhasil mengahpus data');
        } catch (\Throwable $th) {
            return redirect('/dashboard/tiperumah/data')->with('status', 'Gagal mengahpus data');
        }
    }

    public function listProperti()
    {
        try {
            $data = Tipe::leftJoin('kavling', 'kavling.id', 'tipe_rumah.id_kavling')
            ->where('tipe_rumah.status', 'Ready')
            ->select('tipe_rumah.*', 'kavling.nama_kavling', 'kavling.no_kavling')
                ->get();
            // return $data;
            return view('dashboard.tipeRumah.listProperti', compact('data'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function detailProperti($id)
    {
        try {
            $data = Tipe::leftJoin('kavling', 'kavling.id', 'tipe_rumah.id_kavling')
                ->where('tipe_rumah.id', $id)
                ->select('tipe_rumah.*', 'kavling.nama_kavling', 'kavling.no_kavling')
                ->first();
            // return $data;
            return view('dashboard.tipeRumah.detailProperti', compact('data'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
