<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Peserta;
use App\Models\Kompetensi;
use App\Models\Pengajuan;

class DaftarController extends Controller
{
    public function index(){
		$data = [
            'skema'     => Kompetensi::where('status','=',1)->get(),
        ];
		return view('daftar')->with($data);
	}


	public function store(Request $request){
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
        $peserta->email                 = $request->input('email');
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

        $pengajuan->save();

        return redirect('/daftar')->with('sukses','Selamat Anda telah berhasil mendaftar');
	}
}
