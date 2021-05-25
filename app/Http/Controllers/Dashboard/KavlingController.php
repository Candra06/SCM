<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kavling;

class KavlingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kavling::all();
        return view('dashboard.kavling.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.kavling.add');
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
            Kavling::create( $request->validate([
                'nama_kavling' => 'required',
                'no_kavling' => 'required',
                'status' => 'required',
            ]));
            return redirect('/dashboard/kavling/index')->with('status', 'Berhasil menambah data');
        } catch (\Throwable $th) {
            return $th;
            return redirect('/dashboard/kavling/index/create')->with('status', 'Gagal menambah data');
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
        $kavling = Kavling::where('id', $id)->first();
        return view('dashboard.kavling.edit', compact('kavling'));
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
        try {
            Kavling::where('id', $id)->update( $request->validate([
                'nama_kavling' => 'required',
                'no_kavling' => 'required',
                'status' => 'required',
            ]));
            return redirect('/dashboard/kavling/index')->with('status', 'Berhasil mengubah data');
        } catch (\Throwable $th) {
            return $th;
            return redirect('/dashboard/kavling/index/'.$id.'/edit')->with('status', 'Gagal mengubah data');
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
            Kavling::where('id', $id)->delete();
            return redirect('/dashboard/kavling/index')->with('status', 'Berhasil mengahpus data');
        } catch (\Throwable $th) {
            return redirect('/dashboard/kavling/index')->with('status', 'Gagal mengahpus data');
        }
    }
}
