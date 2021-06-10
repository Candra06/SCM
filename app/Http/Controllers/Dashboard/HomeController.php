<?php

namespace App\Http\Controllers\Dashboard;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Pelanggan;
use App\User;
use App\Quote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id == 3) {
            $data = Pelanggan::where('id_akun', Auth::user()->id)->first();
            // return $data;
            return view('dashboard.home.homePelanggan');
        } else {
            return view('dashboard.home.index',);
        }
    }

    public function dashboardPelanggan()
    {
        $data = Pelanggan::where('id_akun', Auth::user()->id)->first();
        // return $data;
        return view('dashboard.home.homePelanggan', compact('data'));
    }
}
