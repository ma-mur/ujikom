<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Laporan;

use PDF;

class LaporanController extends Controller
{
    public function index(Request $request){
		$tahun = $request->input('tahun');
		if ($tahun == '') {
			$laporan = Laporan::join('kompetensis','laporans.id_kompetensi','=','kompetensis.id')
							->select(DB::raw('tahun, kompetensis.nama_kompetensi, status_kompeten,COUNT(status_kompeten) as jumlah'))
							->groupBy('tahun','status_kompeten','kompetensis.nama_kompetensi')->get();	
		}else{
			$laporan = Laporan::where('tahun', '=', $tahun)
							->join('kompetensis','laporans.id_kompetensi','=','kompetensis.id')
							->select(DB::raw('tahun, kompetensis.nama_kompetensi, status_kompeten,COUNT(status_kompeten) as jumlah'))
							->groupBy('tahun','status_kompeten','kompetensis.nama_kompetensi')->get();
		}
		
		$thn 	= Laporan::select('tahun')->groupBy('tahun')->get();

		$kompeten = Laporan::where('status_kompeten', '=', 'Kompeten')
							->select(DB::raw('tahun,status_kompeten,COUNT(status_kompeten) as jumlah'))->groupBy('status_kompeten','tahun')->get();
		$belum = Laporan::where('status_kompeten', '=', 'Belum')
							->select(DB::raw('tahun,status_kompeten,COUNT(status_kompeten) as jumlah'))->groupBy('status_kompeten','tahun')->get();
		
		$data = [
			'laporan' 	=> $laporan,
			'gruptahun'	=> $thn,
			'year'		=> $tahun,
		];

		// dd($data);

		return view('adm.laporan.laporan')->with($data);
	}

	public function pdf(Request $request){
		$tahun = $request->input('tahun');
		if ($tahun == '') {
			$laporan = Laporan::join('kompetensis','laporans.id_kompetensi','=','kompetensis.id')
							->select(DB::raw('*, kompetensis.nama_kompetensi'))->get();	
		}else{
			$laporan = Laporan::where('tahun', '=', $tahun)
							->join('kompetensis','laporans.id_kompetensi','=','kompetensis.id')
							->select(DB::raw('*, kompetensis.nama_kompetensi'))->get();
		}

		$data = [
			'cetak' => $laporan,
		];

		$pdf = PDF::loadView('adm.laporan.pdf',$data);
		return $pdf->stream('Laporan-'.date('dMY').'.pdf');
		// return view('adm.laporan.pdf')->with($data);
	}
}
