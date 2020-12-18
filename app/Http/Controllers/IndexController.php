<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Informasi;
use App\Models\Kompetensi;

class IndexController extends Controller
{
    
	public function index(){
		$data = [
			'info' => Informasi::first(),
			'skema' => Kompetensi::all(),
		];

		return view('index')->with($data);
	}

}
