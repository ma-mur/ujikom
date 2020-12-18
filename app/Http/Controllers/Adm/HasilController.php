<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pengajuan;
use App\Models\Laporan;

use PDF;

class HasilController extends Controller
{
     public function index(){
    
    	$data = [
    		'pengajuan' => Pengajuan::join('kompetensis','pengajuans.id_kompetensi','=','kompetensis.id')
                                    ->select('pengajuans.*','kompetensis.nama_kompetensi')
                                    ->leftjoin('laporans', 'pengajuans.id', '=', 'laporans.id_pengajuan')
                                    ->whereNull('laporans.id_pengajuan')
                                    ->orderBy('pengajuans.id','desc')->get(),
            'skema'     => Pengajuan::join('kompetensis','pengajuans.id_kompetensi','=','kompetensis.id')
                                    ->select('kompetensis.nama_kompetensi','pengajuans.id_kompetensi')
                                    ->leftjoin('laporans', 'pengajuans.id', '=', 'laporans.id_pengajuan')
                                    ->whereNull('laporans.id_pengajuan')
                                    ->groupBy('kompetensis.nama_kompetensi','pengajuans.id_kompetensi')->get(),
    	];
    	return view('adm.pengajuan.hasil')->with($data);
    }

    public function nilai($id){
    	$pengajuan = Pengajuan::where('pengajuans.id', '=', $id)
                        ->join('kompetensis','pengajuans.id_kompetensi','=','kompetensis.id')
                        ->select('pengajuans.*','kompetensis.nama_kompetensi')->get();

    	return response()->json([
    		'data' => $pengajuan,
    	]);
    }

    public function saveNilai(Request $request){
        $nilai = new Laporan;        
        $nilai->nik                 = $request->input('nik');
        $nilai->nama_lengkap        = $request->input('nama_lengkap');
        $nilai->institusi           = str_replace(' ', '_', $request->input('institusi'));
        $nilai->id_kompetensi       = $request->input('id_kompetensi');
        $nilai->tanggal_pengajuan   = $request->input('tanggal');
        $nilai->status_kompeten     = $request->input('status');
        $nilai->tahun               = $request->input('tahun');
        $nilai->id_pengajuan        = $request->input('id');
        $nilai->save();

        return redirect('/adm/hasil')->with('sukses','Peserta berhasil dinilai');
    }

    public function cetak(Request $request){
        $skema = $request->input('skema');

        if ($skema == 'semua') {
            $cetak = Pengajuan::join('kompetensis','pengajuans.id_kompetensi','=','kompetensis.id')
                                    ->select('pengajuans.*','kompetensis.nama_kompetensi')
                                    ->leftjoin('laporans', 'pengajuans.id', '=', 'laporans.id_pengajuan')
                                    ->whereNull('laporans.id_pengajuan')
                                    ->orderBy('pengajuans.id','desc')->get();
        }else{
             $cetak = Pengajuan::where('pengajuans.id_kompetensi', '=', $skema)
                                    ->join('kompetensis','pengajuans.id_kompetensi','=','kompetensis.id')
                                    ->select('pengajuans.*','kompetensis.nama_kompetensi')
                                    ->leftjoin('laporans', 'pengajuans.id', '=', 'laporans.id_pengajuan')
                                    ->whereNull('laporans.id_pengajuan')
                                    ->orderBy('pengajuans.id','desc')->get();
        }   

        $data = [
            'cetak' => $cetak,
            'oke' => 'oke',
        ];

        if ($skema == '') {
            return redirect('/adm/hasil');
        }

        $pdf = PDF::loadView('adm.pengajuan.cetak',$data);

        return $pdf->download('Data-Peserta-'.date('dMY').'.pdf');
        // return view('adm.pengajuan.cetak')->with($data);
    }
}
