<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Informasi;

class InformasiController extends Controller
{
    public function index(){
		$data = [
			'info'		=> Informasi::first(),
		];

		return view('adm.informasi')->with($data);
	}

	public function update(Request $request, $id){
		$info = Informasi::find($id);
		if ($request->input('informasi') == '') {
			$info->informasi = '';
		}else{
			$info->informasi = $request->input('informasi');
		}
		
		$info->save();

		return redirect('/adm/informasi')->with('sukses','Informasi telah diperbarui');
	}
}
