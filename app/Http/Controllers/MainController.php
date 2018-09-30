<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
    	if (session('login') != true) {
	    	return redirect()->route('login');
	    } else {
	    	dd(session()->all());
	    }
    }
}
