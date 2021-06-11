<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Kontraktor;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class KontraktorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kontraktor::leftJoin('users', 'users.id', 'kontraktor.id_akun')
            ->leftJoin('roles', 'roles.id', 'users.role_id')
            ->select('kontraktor.*', 'users.email', 'roles.role')
            ->get();
//        $data = [];

        return view('dashboard.kontraktor.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::all();
        return view('dashboard.kontraktor.add', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
        try {
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'role_id' => $request->role,
                'password' => bcrypt($request->password),
            ]);

            Kontraktor::create([
                'id_akun' => $user->id,
                'nama' => $request->nama,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
                'status' => 'Aktif',
            ]);
            return redirect(url('/dashboard/kontraktor/data'))->with('status', 'Berhasil menambahkan kontraktor');
        } catch (\Throwable $th) {
            throw $th;
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
        $data = Kontraktor::leftJoin('users', 'users.id', 'kontraktor.id_akun')
            ->leftJoin('roles', 'roles.id', 'users.role_id')
            ->select('kontraktor.*', 'users.email', 'roles.role')
            ->where('kontraktor.id', $id)
            ->first();
        return view('dashboard.kontraktor.edit', compact('data'));
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
            'nama' => 'required',
            'email' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
            'status' => 'required',
        ]);
        // return $request;
        try {
            $dt['name'] = $request->nama;
            $dt['email'] = $request->email;
            if ($request->password != null) {
                $dt['password'] = bcrypt($request->password);
            }

            $user = User::where('id', $request->id_akun)->update($dt);

            Kontraktor::where('id', $id)->update([
                'nama' => $request->nama,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
                'status' => $request->status,
            ]);
            return redirect(url('/dashboard/kontraktor/data'))->with('status', 'Berhasil mengubah kontraktor');
        } catch (\Throwable $th) {
            return redirect(url('/dashboard/kontraktor/data/'.$id.'/edit'))->with('status', 'Gagal mengubah kontraktor');
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
