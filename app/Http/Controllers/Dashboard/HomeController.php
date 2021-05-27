<?php

namespace App\Http\Controllers\Dashboard;

use App\Contact;
use App\Http\Controllers\Controller;
use App\User;
use App\Quote;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::whereNotIn('id', [1])->where('role_id', 3)->count();
        $datapembelian = DB::table("pembelian")->paginate(10);

        return view('dashboard.home.index', compact('user', 'datapembelian'));
    }


}
