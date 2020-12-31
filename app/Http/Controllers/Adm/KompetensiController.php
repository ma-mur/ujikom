<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kompetensi;

class KompetensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'skema'     => Kompetensi::all(),
        ];
        return view('adm.skema.skema')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adm.skema.tambah');
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
            'nama_kompetensi' => 'required',
            'keterangan' => 'required',
            'harga_stmik' => 'required',
            'harga_umum' => 'required',
            'jenis_kompetensi' => 'required',
        ]);

        $skema = new Kompetensi;
        $skema->nama_kompetensi     = $request->input('nama_kompetensi');
        $skema->deskripsi           = $request->input('keterangan');
        $skema->harga_stmik         = str_replace('.', '', $request->input('harga_stmik'));
        $skema->harga_umum          = str_replace('.', '', $request->input('harga_umum'));
        $skema->status_promo        = '0';
        $skema->jenis_kompetensi    = str_replace('.', '', $request->input('jenis_kompetensi'));
        $skema->masa_berlaku        = str_replace('.', '', $request->input('masa_berlaku'));
        $skema->status              = '1';
        $skema->save();

        return redirect('/adm/skema')->with('sukses','Skema kompetensi berhasil ditambahkan');
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
            'skema'     => Kompetensi::find($id),
        ];

        return view('adm.skema.edit')->with($data);
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
        $skema = Kompetensi::find($id);
        $skema->nama_kompetensi     = $request->input('nama_kompetensi');
        $skema->deskripsi           = $request->input('keterangan');
        $skema->harga_stmik         = str_replace('.', '', $request->input('harga_stmik'));
        $skema->harga_umum          = str_replace('.', '', $request->input('harga_umum'));
        if ($request->input('status_promo') == '1') {
            $skema->status_promo        = $request->input('status_promo');
            $skema->promo_stmik         = str_replace('.', '', $request->input('promo_stmik'));
            $skema->promo_umum          = str_replace('.', '', $request->input('promo_umum'));
        }elseif ($request->input('status_promo') == '') {
            $skema->status_promo        = '0';
            $skema->promo_stmik         = '0';
            $skema->promo_umum          = '0';
        }

        $skema->jenis_kompetensi    = $request->input('jenis_kompetensi');
        $skema->masa_berlaku        = $request->input('masa_berlaku');
        $skema->save();

        return redirect('/adm/skema')->with('sukses','Skema kompetensi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skema = Kompetensi::find($id);
        $skema->delete();

        return redirect('/adm/skema')->with('sukses','Skema Kompetensi berhasil dihapus');
    }

    public function status_aktif($id){
        $skema = Kompetensi::find($id);
        $skema->status = '1';
        $skema->save();

        return redirect('/adm/skema')->with('sukses','Status berhasil diubah');
    }

    public function status_nonaktif($id){
        $skema = Kompetensi::find($id);
        $skema->status = '0';
        $skema->save();

        return redirect('/adm/skema')->with('sukses','Status berhasil diubah');
    }
}
