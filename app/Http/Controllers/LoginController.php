<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use App\Models\Peserta;
// use App\Models\User;

class LoginController extends Controller
{
	// public function __construct(){
		// $this->middleware('guest:peserta');
	// }

    public function index(){
    	return view('masuk');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

    	$data = [
            'email'     => strtolower($request->input('email')),
            'password'  => $request->input('password'),
        ];

    	if (Auth::guard('peserta')->attempt($data)) {
    		return redirect()->intended('/home/belum');
    	}elseif(Auth::guard('admin')->attempt($data)){
            return redirect()->intended('/adm/peserta');
        }else{
    		return redirect('/masuk')->with('info','Kesalahan saat login, silahkan ulang lagi');
    	}
    }

    public function logout(){
    	if (Auth::guard('peserta')->check()) {
    		Auth::guard('peserta')->logout();
    	}
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

    	return redirect('/masuk');
    }
}
