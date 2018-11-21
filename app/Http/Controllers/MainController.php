<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Ifsnop\Mysqldump as IMysqldump;

use Apfelbox\FileDownload\FileDownload;

use App\Kos;
use App\VKos;
use DB;

class MainController extends Controller
{
    public function index(Request $request)
    {
        // inputan
        $inputs = $request->all();
        $inputs['prop'] = isset($inputs['prop']) ? $inputs['prop'] : null;
        $inputs['kab'] = isset($inputs['kab']) ? $inputs['kab'] : null;
        $inputs['kec'] = isset($inputs['kec']) ? $inputs['kec'] : null;
        $inputs['desa'] = isset($inputs['desa']) ? $inputs['desa'] : null;
        
        // parameter cari kos
        $paramCariKos = [];
        if ($inputs['prop'] != null) { $paramCariKos[] = ['prop_id', '=', $inputs['prop']]; }
        if ($inputs['kab'] != null) { $paramCariKos[] = ['kab_id', '=', $inputs['kab']]; }
        if ($inputs['kec'] != null) { $paramCariKos[] = ['kec_id', '=', $inputs['kec']]; }
        if ($inputs['desa'] != null) { $paramCariKos[] = ['desa_id', '=', $inputs['desa']]; }
        if (isset($inputs['tipe'])) { $paramCariKos[] = ['tipe', '=', $inputs['tipe']]; }
        if (isset($inputs['alamatverifikasi'])) { $paramCariKos[] = ['verified_alamat', '=', $inputs['alamatverifikasi']]; }
        if (isset($inputs['kamartersediamin'])) { $paramCariKos[] = ['kamartersedia', '>=', $inputs['kamartersediamin']]; }
        if (isset($inputs['kamartersediamax'])) { $paramCariKos[] = ['kamartersedia', '<=', $inputs['kamartersediamax']]; }
        if (isset($inputs['bulanmin'])) { $paramCariKos[] = ['bulanan', '>=', $inputs['bulanmin']]; }
        if (isset($inputs['bulanmax'])) { $paramCariKos[] = ['bulanan', '<=', $inputs['bulanmax']]; }
        if (isset($inputs['tahunmin'])) { $paramCariKos[] = ['tahunan', '>=', $inputs['tahunmin']]; }
        if (isset($inputs['tahunmax'])) { $paramCariKos[] = ['tahunan', '<=', $inputs['tahunmax']]; }
        
        $kosts = VKos::where($paramCariKos)->get();

    	return view('frontend.dashboard', compact(['inputs', 'kosts', 'paramCariKos']))->with('pustaka', new \agungdh\Pustaka());	
    }

	public function dashboard()
	{   
		if (!in_array(session('level'), ['a', 'p', 'u'])) {
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

    public function tentangKami()
    {
        return view('template.tentangkami');  
    }

    public function hubungiKami()
    {
        return view('template.hubungikami');  
    }

    public function metodePembayaran()
    {
        return view('template.metodepembayaran');  
    }

}
