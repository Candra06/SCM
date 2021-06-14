<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use App\Pembelian;
use App\Tipe;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Tipe::leftJoin('kavling', 'kavling.id', 'tipe_rumah.id_kavling')
            ->where('tipe_rumah.status', 'Ready')
            ->select('tipe_rumah.*', 'kavling.nama_kavling', 'kavling.no_kavling')
                ->get();
        return view('frontend.master', compact('data'));
    }

    public function register()
    {
        return view('frontend.pemesanan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            'alamat_ktp' => 'required',
            'nik' => 'required',
            'telepon' => 'required'
            ]);
        try {
            $user =User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id'=>3
            ]);
            Pelanggan::create([
                'id_akun' => $user->id,
                'nama' => $request->nama,
                'nik' => $request->nik,
                'telepon' => $request->telepon,
                'alamat_ktp' => $request->alamat_ktp,
            ]);
            return redirect('daftar')->with('sukses', 'Pendaftaran Berhasil');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect('daftar')->with('error', 'Pendaftaran Gagal');
        }
        return $request;
    }
}
