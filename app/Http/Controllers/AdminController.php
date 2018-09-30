<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('CustomAuth:a,p');
	}

	public function dashboard()
	{
        return view('template.backend.template');
	}

    public function profile()
    {
    	
    }

    public function doProfile()
    {
    	
    }

    public function chpass()
    {
    	
    }

    public function doChpass()
    {
    	
    }

    public function foto()
    {

    }

    public function doFoto()
    {

    }
}
