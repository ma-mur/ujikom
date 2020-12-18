<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

use App\Models\Pengajuan;
use App\Models\Kompetensi;
use App\Models\Jadwal;
use App\Models\Peserta;
use App\Models\Laporan;

use PDF;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth:peserta');       
    }

    // ============= Halaman Home =============
    public function index($status){
        $userNIK = Auth::guard('peserta')->user()->nik;
        if ($status == 'belum') {
            $kompetensi = Pengajuan::where('pengajuans.nik', '=', $userNIK)
                                   ->join('kompetensis','pengajuans.id_kompetensi','=','kompetensis.id')
                                   ->select('pengajuans.*','kompetensis.nama_kompetensi')
                                   ->leftjoin('laporans', 'pengajuans.id', '=', 'laporans.id_pengajuan')
                                   ->whereNull('laporans.id_pengajuan')
                                   ->orderBy('pengajuans.id','desc')->get();

        }else{
            $kompetensi = Pengajuan::where('nik', '=', $userNIK)
                                   ->join('kompetensis','pengajuans.id_kompetensi', '=', 'kompetensis.id')
                                   ->select('Pengajuans.*','kompetensis.nama_kompetensi','kompetensis.jenis_kompetensi','kompetensis.deskripsi')
                                   ->orderBy('id','desc')->get();
        }

    	$data = [
            'kompetensi' => $kompetensi,
            'lapor' => Laporan::where('nik', '=', $userNIK)->get(),
    	];
    	return view('peserta.home')->with($data);
    }

    public function bayar(Request $request){
        // Bukti
        $BuktiWithExt     = $request->file('bukti')->getClientOriginalName();
        $Bukti            = pathinfo($BuktiWithExt, PATHINFO_FILENAME);
        $BuktiExt         = $request->file('bukti')->getClientOriginalExtension();
        $BuktiStore       = str_replace(' ', '_', $Bukti).'_'.time().'.'.$BuktiExt;
        $pathBukti        = $request->file('bukti')->storeAs('public/bukti',$BuktiStore);

        $bayar = Pengajuan::find($request->input('id'));
        $bayar->bukti_pembayaran    = $BuktiStore;
        $bayar->waktu_pembayaran    = date('y-m-d H:i:s');
        $bayar->save();

        return back()->with('sukses', 'Bukti berhasil diupload');
    }

    // ============= Halaman Pembayaran =============
    public function pembayaran(){
        $userNIK = Auth::guard('peserta')->user()->nik;
    	$data = [
    		'kompetensi'	=> Pengajuan::where('nik', '=', $userNIK)
    									->join('kompetensis','pengajuans.id_kompetensi', '=', 'kompetensis.id')
    									->select('Pengajuans.*','kompetensis.nama_kompetensi','kompetensis.jenis_kompetensi','kompetensis.deskripsi')
                                        ->orderBy('id','desc')->get(),
    	];
    	return view('peserta.pembayaran')->with($data);
    }

    // ============= Halaman Jadwal =============
    public function jadwal(){
        $userNIK = Auth::guard('peserta')->user()->nik;
        $data = [
            'jadwal'  => Pengajuan::where('pengajuans.nik', '=', $userNIK)
                                    ->join('kompetensis', 'pengajuans.id_kompetensi', '=', 'kompetensis.id')
                                    ->join('jadwals', 'pengajuans.id_kompetensi', '=', 'jadwals.id_kompetensi')
                                    ->select('pengajuans.id_kompetensi', 'pengajuans.id', 'pengajuans.konfirmasi_pembayaran', 'kompetensis.nama_kompetensi','jadwals.jam','jadwals.tanggal','jadwals.tempat','jadwals.deskripsi','jadwals.asesor')
                                    ->leftjoin('laporans', 'pengajuans.id', '=', 'laporans.id_pengajuan')
                                   ->whereNull('laporans.id_pengajuan')->get(),
        ];

        return view('peserta.jadwal')->with($data);
    }

    // ============= Halaman Hasil =============
    public function hasil(){
        $userNIK = Auth::guard('peserta')->user()->nik;
        $data = [
            'laporan'    => Laporan::where('nik', '=', $userNIK)
                                        ->join('kompetensis','laporans.id_kompetensi', '=', 'kompetensis.id')
                                        ->select('laporans.*','kompetensis.nama_kompetensi','kompetensis.jenis_kompetensi','kompetensis.deskripsi')->get(),
        ];

        return view('peserta.hasil')->with($data);
    }


    // ============= Halaman Profile =============
    public function profile(){
        $userNIK = Auth::guard('peserta')->user()->nik;
        $data  = [
            'profile'   => Peserta::where('nik','=',$userNIK)->first(),
            'skema'     => Peserta::where('nik','=',$userNIK)
                                    ->join('kompetensis','pesertas.id_kompetensi','=','kompetensis.id')
                                    ->select(DB::raw('kompetensis.nama_kompetensi,count(pesertas.id_kompetensi) as jumlah'))
                                    ->groupBy('kompetensis.nama_kompetensi')->get(),
        ];

        return view('peserta.profile')->with($data);
    }

    public function ubahPass(Request $request){
        $userNIK = Auth::guard('peserta')->user()->nik;
        $data = Peserta::where('nik','=',$userNIK)->get();
        foreach ($data as $d) {
            if ($d->password == Hash::make($request->input('pass-lama'))) {
                if ($request->input('pass-baru') == $request->input('konfirmasi')) {
                    $password = $request->input('pass-baru');
                    $updt = DB::table('pesertas')->where('nik','=', $userNIK)->update(['password'=>$password]);
                    if ($updt == true) {
                        return redirect('/profile')->with('sukses','Password berhasil diubah');            
                    }else{
                        return redirect('/profile')->with('gagal','Password gagal diubah');
                    }
                }
            }   
        }        
    }

    // ============= Bukti =============
    public function bukti(Request $request){
        $id = $request->input('id');
        $jenis = $request->input('jenis');
        $userEMAIL = Auth::guard('peserta')->user()->email;
        $detail = Pengajuan::join('kompetensis', 'pengajuans.id_kompetensi', '=', 'kompetensis.id')
                        ->select('pengajuans.*', 'kompetensis.nama_kompetensi','kompetensis.jenis_kompetensi')->find($id);

        $data = [
            'detail' => $detail,
            'email' => $userEMAIL,
            'jenis' => $jenis,
        ];
        $pdf = PDF::loadView('peserta.bukti',$data);
        return $pdf->stream('bukti-'.$jenis.'-'.date('dMY').'.pdf');
        // return view('peserta.bukti');
    }

    public function resetPassword(Request $request){
        $status = Password::reset(
            $request->only('email','password','password_conffirmation'),
            function ($peserta,$password) use ($request){
                $peserta->forceFill([
                    'password' => Hash::make($password)
                ])->save();

                event(new PasswordReset($peserta));
            }
        );

        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => __($status)]);
    }

}
