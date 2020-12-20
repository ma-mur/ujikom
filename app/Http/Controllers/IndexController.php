<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Informasi;
use App\Models\Kompetensi;
use App\Models\Laporan;

class IndexController extends Controller
{
    
	public function index(){
		$data = [
			'info' 		=> Informasi::first(),
			'skema' 	=>  Kompetensi::where('status','=',1)->get(),
			'laporan' 	=> Laporan::join('kompetensis','laporans.id_kompetensi','=','kompetensis.id')
							->select(DB::raw('tahun, kompetensis.nama_kompetensi, status_kompeten,COUNT(status_kompeten) as jumlah'))
							->groupBy('tahun','status_kompeten','kompetensis.nama_kompetensi')->get(),
		];

		return view('index')->with($data);
	}

}
