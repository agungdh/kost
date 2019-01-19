<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Ifsnop\Mysqldump as IMysqldump;

use Apfelbox\FileDownload\FileDownload;

use App\Kos;
use App\VKos;
use App\Transaksi;
use DB;
use Dompdf\Dompdf;
use agungdh\Pustaka;
use App\Helpers\notifMail;

class MainController extends Controller
{
    public function __construct() {

    }

    public function index_new(Request $request)
    {
        $inputs = $request->all();

        return view('frontend.dashboard', compact(['inputs']))
            ->with('pustaka', new \agungdh\Pustaka())
            ->with('fullUrl', $request->fullUrl());
    }

    function invoice($id_trx) {
        $trx = Transaksi::find($id_trx);

        if (!$trx || $trx->status != 'a') {
            return redirect(url('/'));
        }
        $html = view('template.pdf.invoice', compact(['trx']))->with('pustaka', new \agungdh\Pustaka())->render();
        // echo $html; die;
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("Invoice {$trx->id}");
    }

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
        
        // jumlah per halaman
        if (isset($inputs['jumlahperhalaman'])) { $inputs['jumlahperhalaman'] = intval($inputs['jumlahperhalaman']); } else { $inputs['jumlahperhalaman'] = 5; }
        if ($inputs['jumlahperhalaman'] < 1) { $inputs['jumlahperhalaman'] = 5; }

        // halaman
        if (isset($inputs['page'])) { $inputs['page'] = intval($inputs['page']); } else { $inputs['page'] = 1; }
        if ($inputs['page'] < 1) { $inputs['page'] = 1; }

        // urut
        if (!isset($inputs['urut'])) { $inputs['urut'] = 'namaa'; }
        switch ($inputs['urut']) {
            case 'namaa':
            $orderVar = 'nama';
            $orderVal = 'asc';
            break;
            case 'namaz':
            $orderVar = 'nama';
            $orderVal = 'desc';
            break;
            case 'alamata':
            $orderVar = 'alamat';
            $orderVal = 'asc';
            break;
            case 'alamatz':
            $orderVar = 'alamat';
            $orderVal = 'desc';
            break;
            case 'provinsia':
            $orderVar = 'nama_prop';
            $orderVal = 'asc';
            break;
            case 'provinsiz':
            $orderVar = 'nama_prop';
            $orderVal = 'desc';
            break;
            case 'kabupatena':
            $orderVar = 'nama_kab';
            $orderVal = 'asc';
            break;
            case 'kabupatenz':
            $orderVar = 'nama_kab';
            $orderVal = 'desc';
            break;
            case 'kecamatana':
            $orderVar = 'nama_kec';
            $orderVal = 'asc';
            break;
            case 'kecamatanz':
            $orderVar = 'nama_kec';
            $orderVal = 'desc';
            break;
            case 'kelurahana':
            $orderVar = 'nama_desa';
            $orderVal = 'asc';
            break;
            case 'kelurahanz':
            $orderVar = 'nama_desa';
            $orderVal = 'desc';
            break;
            case 'tipea':
            $orderVar = 'tipe';
            $orderVal = 'asc';
            break;
            case 'tipez':
            $orderVar = 'tipe';
            $orderVal = 'desc';
            break;
            case 'bulanana':
            $orderVar = 'bulanan';
            $orderVal = 'asc';
            break;
            case 'bulananz':
            $orderVar = 'bulanan';
            $orderVal = 'desc';
            break;
            case 'tahunana':
            $orderVar = 'tahunan';
            $orderVal = 'asc';
            break;
            case 'tahunanz':
            $orderVar = 'tahunan';
            $orderVal = 'desc';
            break;
            case 'kamartersediaa':
            $orderVar = 'kamartersedia';
            $orderVal = 'asc';
            break;
            case 'kamartersediaz':
            $orderVar = 'kamartersedia';
            $orderVal = 'desc';
            break;
            case 'emailpemilika':
            $orderVar = 'email';
            $orderVal = 'asc';
            break;
            case 'emailpemilikz':
            $orderVar = 'email';
            $orderVal = 'desc';
            break;
            case 'namapemilika':
            $orderVar = 'nama_user';
            $orderVal = 'asc';
            break;
            case 'namapemilikz':
            $orderVar = 'nama_user';
            $orderVal = 'desc';
            break;
            case 'nohppemilika':
            $orderVar = 'nohp';
            $orderVal = 'asc';
            break;
            case 'nohppemilikz':
            $orderVar = 'nohp';
            $orderVal = 'desc';
            break;  

            default:
            $orderVar = 'nama';
            $orderVal = 'asc';
            break;
        }

        $kosts = VKos::where($paramCariKos)
                    ->orderBy($orderVar, $orderVal)
                    ->paginate($inputs['jumlahperhalaman']);

        if ($inputs['page'] > $kosts->lastPage()) {
            return redirect($request->fullUrl() . '&page=' . $kosts->lastPage());
        }

        if (count($request->all()) > 0) { $inputs['uqm'] = false; } else { $inputs['uqm'] = true; }

        return view('frontend.dashboard', compact(['inputs', 'kosts', 'paramCariKos']))
            ->with('pustaka', new \agungdh\Pustaka())
            ->with('fullUrl', $request->fullUrl()); 
    }

    public function dashboard()
    {   
        // if (!in_array(session('level'), ['a', 'p', 'u'])) {
  //           return redirect(route('login'));
  //       } else {
  //        return view('backend.dashboard');
  //       }

        switch (session('level')) {
             case 'a':
                 return view('backend.dashboard.admin')->with('pustaka', new \agungdh\Pustaka());
                 break;
             case 'p':
                 return view('backend.dashboard.pemilik')->with('pustaka', new \agungdh\Pustaka());
                 break;
             case 'u':
                 return view('backend.dashboard.user')->with('pustaka', new \agungdh\Pustaka());
                 break;
             default:
                 return redirect(route('login'));
                 break;
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

    public function pesan($id_kos)
    {
        if (!in_array(session('level'), ['u'])) {
            return redirect(route('root'))->with('alert', [
                        'title' => 'ERROR !!!',
                        'message' => 'Hanya User Dengan Level Pencari Kos Yang Dapat Memesan !!!',
                        'class' => 'error',
                    ]);
        }

        $kos = VKos::find($id_kos);

        return view('frontend.pesan', compact(['kos']))->with('pustaka', new Pustaka());  
    }

    public function doPesan(Request $request, $id_kos)
    {
        $kos = Kos::find($id_kos);
        
        if (!in_array(session('level'), ['u'])) {
            return redirect(route('root'))->with('alert', [
                        'title' => 'ERROR !!!',
                        'message' => 'Hanya User Dengan Level Pencari Kos Yang Dapat Memesan !!!',
                        'class' => 'error',
                    ]);
        }

        $data = $request->only('jumlah_kamar', 'lama_kost');
        $data['user_id_pencari_kos'] = session('id');
        $data['kos_id'] = $id_kos;
        $data['waktu_transaksi'] = date('Y-m-d H:i:s');
        // if ($request->pembayaran == 'b') {
        //     $data['harga'] = $request->jumlah_kamar * ($request->lama_kost * $kos->bulanan);
        //     $data['jenis_lama_kost'] = 'b';
        // } elseif ($request->pembayaran == 't') {
        //     $data['harga'] = $request->jumlah_kamar * ($request->lama_kost * $kos->tahunan);
        //     $data['jenis_lama_kost'] = 't';
        // }
        $data['harga'] = $request->jumlah_kamar * ($request->lama_kost * $kos->tahunan);

        $id_trx = Transaksi::insertGetId($data);

        notifMail::userPesan($id_trx);

        return redirect(route('pesananUser.index'))->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Pesanan telah diterima, silakan upload bukti transfer uang !!!',
                        'class' => 'success',
                    ]);
    }

    public static function cancelLebihSehari() 
    {
        $trx = Transaksi::select(DB::raw('*, DATE_ADD(waktu_transaksi, INTERVAL 1 DAY) deadline, now() sekarang'))
                ->whereRaw('now() > DATE_ADD(waktu_transaksi, INTERVAL 1 DAY)')
                ->whereNull('waktu_validasi')
                ->whereNull('waktu_upload_bukti')
                ->get();

        $idTrx = [];
        foreach ($trx as $value) {
            $idTrx[] = $value->id;
            notifMail::userAutoCancel($value->id);
        }

        $ttrx = Transaksi::whereIn('id', $idTrx)->update(['status' => 'c', 'waktu_validasi' => date('Y-m-d H:i:s')]);
    }

}
