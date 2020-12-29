<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

use App\Models\Peserta;
use App\Models\Kompetensi;
use App\Models\Pengajuan;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'peserta'       => Peserta::orderBy('id','desc')->get(),
        ];
        return view('adm.peserta.peserta')->with($data);
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
        ];
        return view('adm.peserta.tambah')->with($data);
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
            'nik'                => 'required',
            'nama_lengkap'       => 'required',
            'institusi'          => 'required',
            'skema_kompetensi'   => 'required',
            'ktp'                => 'required|image|max:1999',
            'foto'               => 'required|image|max:1999',
            'email'              => 'required',
            'no_telp'            => 'required',
            'tanggal_lahir'      => 'required',
            'alamat'             => 'required',
        ]);

        // KTP
        $KtpWithExt     = $request->file('ktp')->getClientOriginalName();
        $ktp            = pathinfo($KtpWithExt, PATHINFO_FILENAME);
        $KtpExt         = $request->file('ktp')->getClientOriginalExtension();
        $KtpStore       = str_replace(' ', '_', $ktp).'_'.time().'.'.$KtpExt;
        $pathKtp        = $request->file('ktp')->storeAs('public/ktp',$KtpStore);

        // FOTO
        $FotoWithExt    = $request->file('foto')->getClientOriginalName();
        $foto           = pathinfo($FotoWithExt, PATHINFO_FILENAME);
        $FotoExt        = $request->file('foto')->getClientOriginalExtension();
        $FotoStore      = str_replace(' ', '_', $foto).'_'.time().'.'.$FotoExt;
        $pathFoto       = $request->file('foto')->storeAs('public/foto',$FotoStore);

        $peserta = new Peserta;
        $peserta->nik                   = $request->input('nik');
        $peserta->nama_lengkap          = $request->input('nama_lengkap');
        
        // jika institusi nya lain maka lainnya yang akan terinputkan
        if ($request->input('institusi') == 'lain') {
            $peserta->institusi              = str_replace(' ', '_', $request->input('lainnya'));
        }else{
            $peserta->institusi              = $request->input('institusi');
        }

        $peserta->id_kompetensi         = $request->input('skema_kompetensi');
        $peserta->ktp                   = $KtpStore;
        $peserta->foto                  = $FotoStore;
        $peserta->email                 = strtolower($request->input('email'));
        $peserta->password              = Hash::make($request->input('nik'));
        $peserta->no_telp               = $request->input('no_telp');
        $peserta->tanggal_lahir         = $request->input('tanggal_lahir');
        $peserta->alamat                = $request->input('alamat');
        $peserta->tanggal_pendaftaran   = date('y-m-d H:i:s');
        $peserta->save();

        // Pengajuan
        $pengajuan  = new Pengajuan;
        $pengajuan->nik                      = $request->input('nik');
        $pengajuan->nama_lengkap             = $request->input('nama_lengkap');
        // jika institusi nya lain maka lainnya yang akan terinputkan
        if ($request->input('institusi') == 'lain') {
            $pengajuan->institusi              = str_replace(' ', '_', $request->input('lainnya'));
        }else{
            $pengajuan->institusi              = $request->input('institusi');
        }
        $pengajuan->id_kompetensi            = $request->input('skema_kompetensi');
        $pengajuan->tanggal_pengajuan        = date('y-m-d H:i:s');
        $pengajuan->konfirmasi_pembayaran    = '0';

        // $pengajuan->tagihan = $request->input('');

        $skema = Kompetensi::find($request->input('skema_kompetensi'));

        if ($request->input('institusi') == 'STMIK_Sumedang') {
            if ($skema->status_promo == '1' && $request->input('institusi') == 'STMIK_Sumedang') {

                $pengajuan->tagihan = $skema->promo_stmik;

            }elseif($skema->status_promo == '0' && $request->input('institusi') == 'STMIK_Sumedang'){

                $pengajuan->tagihan = $skema->harga_stmik;

            }            
        }elseif ($request->input('institusi') == 'umum' || $request->input('institusi') == 'lain') {
            if ($skema->status_promo == '1' && $request->input('institusi') == 'umum' || $skema->status_promo == '1' &&  $request->input('institusi') == 'lain') {

                $pengajuan->tagihan = $skema->promo_umum;   

            }elseif($skema->status_promo == '0' && $request->input('institusi') == 'umum' || $skema->status_promo == '0' &&  $request->input('institusi') == 'lain'){

                $pengajuan->tagihan = $skema->harga_umum;

            }
        }

        // coba 1
            // if ($request->input('institusi') == 'STMIK_Sumedang') {
            //     if(status_promo == 1 && $request->input('institusi') == 'STMIK_Sumedang'){
            //        tagihan == promo_stmik
            //     }else{
            //      tagihan == harga_stmik
            //     }
            //     
            // }elseif($request->input('institusi') == 'Umum' || $reques->input('institusi') == 'lain'){
            //     if(status_promo == 1 && $request->input('institusi') == 'Umum' || $request->input('institusi') == 'lain'){
            //        tagihan == promo_umum
            //     }else{
            //        tagihan == harga_umum
            //     }
            // }
        // 

        $pengajuan->save();

        return redirect('/adm/peserta')->with('sukses','Data Peserta berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'detail'    => Peserta::where('pesertas.id','=',$id)
                               ->join('kompetensis','pesertas.id_kompetensi','=','kompetensis.id')
                               ->select('pesertas.*','kompetensis.nama_kompetensi')->get(),
        ];
        return view('adm.peserta.detail')->with($data);
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
            'peserta'   => Peserta::find($id),
            'skema'     => Kompetensi::where('status','=',1)->get(),
        ];
        return view('adm.peserta.edit')->with($data);
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
            'nik'                => 'required',
            'nama_lengkap'       => 'required',
            'institusi'           => 'required',
            'skema_kompetensi'   => 'required',
            'email'              => 'required',
            'no_telp'            => 'required',
            'tanggal_lahir'      => 'required',
            'alamat'             => 'required',
        ]);

        // KTP
        if ($request->hasFile('ktp')) {
            $KtpWithExt     = $request->file('ktp')->getClientOriginalName();
            $ktp            = pathinfo($KtpWithExt, PATHINFO_FILENAME);
            $KtpExt         = $request->file('ktp')->getClientOriginalExtension();
            $KtpStore       = str_replace(' ', '_', $ktp).'_'.time().'.'.$KtpExt;
            $pathKtp        = $request->file('ktp')->storeAs('public/ktp',$KtpStore);   
        }

        // FOTO
        if ($request->hasFile('foto')) {
            $FotoWithExt    = $request->file('foto')->getClientOriginalName();
            $foto           = pathinfo($FotoWithExt, PATHINFO_FILENAME);
            $FotoExt        = $request->file('foto')->getClientOriginalExtension();
            $FotoStore      = str_replace(' ', '_', $foto).'_'.time().'.'.$FotoExt;
            $pathFoto       = $request->file('foto')->storeAs('public/foto',$FotoStore);
        }

        $peserta = Peserta::find($id);
        $peserta->nik                   = $request->input('nik');
        $peserta->nama_lengkap          = $request->input('nama_lengkap');
        $peserta->id_kompetensi         = $request->input('skema_kompetensi');

        // jika institusi nya lain maka lainnya yang akan terinputkan
        if ($request->input('institusi') == 'lain') {
            $peserta->institusi              = str_replace(' ', '_', $request->input('lainnya'));    
        }else{
            $peserta->institusi              = str_replace(' ', '', $request->input('institusi'));
        }

        // jika ktp diganti maka akan menghapus data ktp lama dan diganti dengan data ktp baru
        // jika tidak diganti maka akan tetap
        if ($request->hasFile('ktp')) {
            Storage::delete('public/ktp/'.$peserta->ktp);
            $peserta->ktp               = $KtpStore;
        }else{
            $peserta->ktp               = $request->input('data_ktp');
        }
        
        // jika foto diganti maka akan menghapus data foto lama dan diganti dengan data foto baru
        // jika tidak diganti maka akan tetap
        if ($request->hasFIle('foto')) {
            Storage::delete('public/foto/'.$peserta->foto);
            $peserta->foto              = $FotoStore;
        }else{
            $peserta->foto              = $request->input('data_foto');
        }
        
        $peserta->email                 = strtolower($request->input('email'));

        if ($request->input('passwordnew') == '') {
            $peserta->password              = $request->input('passwordold');
        }else{
            $peserta->password              = Hash::make($request->input('passwordnew'));
        }
        


        $peserta->no_telp               = $request->input('no_telp');
        $peserta->tanggal_lahir         = $request->input('tanggal_lahir');
        $peserta->alamat                = $request->input('alamat');
        $peserta->save();

        return redirect('/adm/peserta')->with('sukses','Data Peserta berhasil diperbarui');
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
