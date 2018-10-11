<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
    	return view('frontend.dashboard');	
    }

	public function dashboard()
	{   
		if (!in_array(session('level'), ['a', 'p'])) {
            return redirect(route('login'));
        } else {
        	return view('backend.dashboard');
        }
    }

}
