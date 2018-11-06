<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Ifsnop\Mysqldump as IMysqldump;

use Apfelbox\FileDownload\FileDownload;

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

    public function dumpDB()
    {
        $database = env('DB_DATABASE');
        $user = env('DB_USERNAME');
        $pass = env('DB_PASSWORD');
        $host = env('DB_HOST');
        
        try {
            $dump = new IMysqldump\Mysqldump("mysql:host={$host};dbname={$database}", "{$user}", "{$pass}");

            $path = base_path('private/db/dump.sql');

            $dump->start($path);

            $fileDownload = FileDownload::createFromFilePath($path);
            $fileDownload->sendDownload("dump.sql");
        } catch (\Exception $e) {
            echo 'mysqldump-php error: ' . $e->getMessage();
        }
    }

}
