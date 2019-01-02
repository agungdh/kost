<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesananPemilik extends Controller
{
    public function __construct()
    {
        $this->middleware('CustomAuth:p');
    }
}
