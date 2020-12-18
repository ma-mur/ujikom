<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kompetensi;
use App\Models\Jadwal;
use App\Models\Asesor;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $skema = Kompetensi::where('status','=',1)->get();
        // foreach ($skema as $s) {
        //     $jadwal = Jadwal::where('id_kompetensi','=',$s->id)->get();
        // }
        $data = [
            'jadwal'    => Jadwal::join('kompetensis','jadwals.id_kompetensi','=','kompetensis.id')
                                           ->select('jadwals.*','kompetensis.nama_kompetensi')->get(),
        ];
        return view('adm.jadwal.jadwal')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'skema'     => Kompetensi::where('status','=',1)->get(),
            'asesor'     => Asesor::where('status','=',1)->get(),
        ];
        return view('adm.jadwal.tambah')->with($data);
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
            'jam'       => 'required',
            'tanggal'   => 'required',
            'tempat'    => 'required',
            'skema'     => 'required',
            'keterangan' => 'required',
            'asesor'    => 'required',
        ]);

        $jadwal = new Jadwal;
        $jadwal->jam            = $request->input('jam');
        $jadwal->tanggal        = $request->input('tanggal');
        $jadwal->tempat         = $request->input('tempat');
        $jadwal->id_kompetensi  = $request->input('skema');
        $jadwal->deskripsi      = $request->input('keterangan');
        $jadwal->asesor         = $request->input('asesor');
        $jadwal->save();

        return redirect('/adm/jadwal')->with('sukses','Jadwal berhasil ditambahkan');
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
        $data = [
            'skema'     => Kompetensi::where('status','=',1)->get(),
            'asesor'     => Asesor::where('status','=',1)->get(),
            'jadwal'    => Jadwal::find($id),
        ];        
        return view('adm.jadwal.edit')->with($data);
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
            'jam'       => 'required',
            'tanggal'   => 'required',
            'tempat'    => 'required',
            'skema'     => 'required',
            'keterangan' => 'required',
            'asesor' => 'required',
        ]);

        $jadwal = Jadwal::find($id);
        $jadwal->jam            = $request->input('jam');
        $jadwal->tanggal        = $request->input('tanggal');
        $jadwal->tempat         = $request->input('tempat');
        $jadwal->id_kompetensi  = $request->input('skema');
        $jadwal->deskripsi      = $request->input('keterangan');
        $jadwal->asesor         = $request->input('asesor');
        $jadwal->save();

        return redirect('/adm/jadwal')->with('sukses','Jadwal berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::find($id);
        $jadwal->delete();

        return redirect('/adm/jadwal')->with('sukses','Jadwal berhasil dihapus');
    }
}
