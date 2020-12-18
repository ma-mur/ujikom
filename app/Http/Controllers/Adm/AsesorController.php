<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Asesor;
use App\Models\User;

class AsesorController extends Controller
{
 	
	public function index(){
		$data = [
			'asesor' => Asesor::all(),
		];

		return view('adm.asesor.asesor')->with($data);
	}

	public function store(Request $request){
		$asesor = new Asesor;
		$asesor->nama_lengkap	= $request->input('nama_lengkap');
		$asesor->institusi		= $request->input('institusi');
		$asesor->status			= '1';
		$asesor->save();

		return redirect('/adm/asesor')->with('suskes','Asesor berhasil ditambahkan');
	}

	public function status_aktif($id){
        $asesor = Asesor::find($id);
        $asesor->status = '1';
        $asesor->save();

        return redirect('/adm/asesor')->with('sukses','Status berhasil diubah');
    }

    public function status_nonaktif($id){
        $asesor = Asesor::find($id);
        $asesor->status = '0';
        $asesor->save();

        return redirect('/adm/asesor')->with('sukses','Status berhasil diubah');
    }

    public function destroy($id){
        $asesor = Asesor::find($id);
        $asesor->delete();

        return redirect('/adm/asesor')->with('sukses','Asesor berhasil dihapus');
    }



    // Admin
    public function admin(){
        $data = [
            'adm' => User::all(),
        ];
        return view('adm.admin')->with($data);
    }

    public function add(Request $request){
        $data = new User;
        $data->name         = $request->input('nama_lengkap');
        $data->email        = $request->input('email');
        $data->password    = Hash::make($request->input('password'));
        $data->save();

        return redirect('/adm/admin')->with('sukses','Admin berhasil ditambahkan');
    }

    public function delete($id){
        $data = User::find($id);
        $data->delete();

        return redirect('/adm/admin')->with('sukses','Admin berhasil dihapus');
    }


}
