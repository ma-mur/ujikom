<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pengajuan;

class PembayaranController extends Controller
{
    public function index($status = ''){
		if ($status == 'belum') {
			$pengajuan = Pengajuan::where('konfirmasi_pembayaran', '=', 0)
							->join('kompetensis','pengajuans.id_kompetensi','=','kompetensis.id')
                            ->select('pengajuans.*','kompetensis.nama_kompetensi')
                            ->orderBy('pengajuans.id','desc')->get();
		}else{
			$pengajuan = Pengajuan::where('konfirmasi_pembayaran', '=', 1)
							->join('kompetensis','pengajuans.id_kompetensi','=','kompetensis.id')
                            ->select('pengajuans.*','kompetensis.nama_kompetensi')
                            ->orderBy('pengajuans.id','desc')->get();
		}

		$data = [
			'pengajuan' => $pengajuan,
		];

		return view('adm.pembayaran')->with($data);
	}

	public function konfirmasi($id){
		$pengajuan = Pengajuan::find($id);
		$pengajuan->konfirmasi_pembayaran = '1';
		$pengajuan->save();

		return redirect('/adm/pembayaran/belum')->with('sukses','Pembayaran berhasil dikonfirmasi');
	}

	public function bukti($id){
    	$pengajuan = Pengajuan::select('bukti_pembayaran')->find($id);

    	return response()->json([
    		'data' => $pengajuan,
    	]);
    }
}
