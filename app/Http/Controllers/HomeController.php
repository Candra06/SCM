<?php

namespace App\Http\Controllers;

use App\Pelanggan;
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
        return view('home');
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
