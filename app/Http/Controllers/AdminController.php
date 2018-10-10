<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Hash;
use Storage;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('CustomAuth:a,p');
	}

	public function dashboard()
	{   
        return view('backend.dashboard');
    }

    public function profile()
    {
        $user = DB::table('user')
                        ->where('id', session('id'))
                        ->first();

        return view('template.backend.profile', compact('user'));
    }

    public function doProfile(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'nohp' => 'required',
        ]);

        $user = $request->only('nama', 'alamat', 'nohp');

        DB::table('user')
                ->where('id', session('id'))
                ->update($user);

        session($user);

        return redirect()->route('profile')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Ubah Profil Berhasil !!!',
                        'class' => 'success',
                    ]);
    }

    public function chpass()
    {
        return view('template.backend.chpass');
    }

    public function doChpass(Request $request)
    {
    	$request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|confirmed',
        ]);

        $user = DB::table('user')->where('id', session('id'))->first();

        if (Hash::check($request->oldpassword, $user->password)) {
            DB::table('user')->where('id', session('id'))->update(['password' => Hash::make($request->newpassword)]);

            return redirect()->route('chpass')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Ubah Password Berhasil !!!',
                        'class' => 'success',
                    ]);
        } 

        return redirect()->route('chpass')->with('alert', [
                        'title' => 'ERROR !!!',
                        'message' => 'Password Salah !!!',
                        'class' => 'error',
                    ]);
    }

    public function foto()
    {
        return view('template.backend.foto');
    }

    public function doFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|max:1024|image',
        ]);

        Storage::putFileAs('public/profilephoto', $request->file('foto'), session('id'));

        return redirect()->route('foto')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Ubah Foto Berhasil !!!',
                        'class' => 'success',
                    ]);
    }

    public function chemail()
    {
        return view('template.backend.chemail');
    }

    public function doChemail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:user,email',
        ]);

        $data['token'] = bin2hex(random_bytes(16));
        $data['temp_email'] = $request->email;

        DB::table('user')->where('id', session('id'))->update($data);

        $user = DB::table('user')->where('id', session('id'))->first();

        if (!Hash::check($request->oldpassword, $user->password)) {
            return redirect()->route('chemail')->with('alert', [
                        'title' => 'ERROR !!!',
                        'message' => 'Password salah !!!',
                        'class' => 'error',
                    ]);
        }

        $html = view('template.email.gantiemail', compact('user'))->with('token', $data['token'])->with('temp_email', $data['temp_email'])->render();

        $this->mail($data['temp_email'], 'Ubah email akun', $html);

        return redirect()->route('chemail')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Silakan cek email baru untuk konfirmasi',
                        'class' => 'success',
                    ]);
    }

    public function confirmChemail(Request $request)
    {
        $user = DB::table('user')
                ->where('token', $request->token)
                ->first();

        if ($user) {
            if (md5($user->id) == $request->head && md5($user->email) == $request->body && md5($user->temp_email) == $request->key) {
                DB::table('user')->where('id', $user->id)->update(['email' => $user->temp_email, 'temp_email' => null, 'token' => null]);

                return redirect()
                        ->route('login')
                        ->with('alert', [
                            'title' => 'SUCCESS !!!',
                            'message' => 'Berhasil ubah email !!!',
                            'class' => 'success',
                        ]);
            }
        }

        return redirect()->route('root');
    }

    // =================
    // Private Functions
    // =================

    private function mail($toEmail, $subject, $body, $html = TRUE) {
        if (!file_exists(base_path('private/config/emailprovider.json'))) {
            echo 'Config not found!';
            die;
        }

        $config = json_decode(file_get_contents(base_path('private/config/emailprovider.json')));   

        if ($config->type == 'local') {
            $this->sendMail($toEmail, $subject, $body, $html);
        } elseif ($config->type == 'smtp') {
            $this->sendSMTPMail($toEmail, $subject, $body, $html);
        } else {
            echo 'Fatal Error !!!';
            die;
        }
    }

    private function sendSMTPMail($toEmail, $subject, $body, $html = TRUE)
    {
        if (!file_exists(base_path('private/config/smtpemail.json'))) {
            echo 'Config not found!';
            die;
        }

        $config = json_decode(file_get_contents(base_path('private/config/smtpemail.json')));

        $data = new \stdClass();

        $mail = new PHPMailer(true);                              
        try {
            $mail->isSMTP();                                      
            $mail->Host = $config->host;  
            $mail->SMTPOptions = [ 'ssl' => [
                                     'verify_peer' => false,
                                     'verify_peer_name' => false,
                                     'allow_self_signed' => true
                                    ]
                                ];
            $mail->SMTPAuth = true;                               
            $mail->Username = $config->username;                 
            $mail->Password = $config->password;                           
            $mail->SMTPSecure = $config->encryption;                            
            $mail->Port = $config->port;                                    

            $mail->setFrom($config->username);
            $mail->addAddress($toEmail);               
            
            $mail->isHTML($html);                                  
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            
            $data->success = true;
        } catch (Exception $e) {
            $data->message = $mail->ErrorInfo;

            $data->success = false;
        }

        return $data;
    }

    private function sendMail($toEmail, $subject, $body, $html = TRUE)
    {
        if (!file_exists(base_path('private/config/email.json'))) {
            echo 'Config not found!';
            die;
        }

        $config = json_decode(file_get_contents(base_path('private/config/email.json')));

        $data = new \stdClass();

        $mail = new PHPMailer(true);                              
        try {
            $mail->setFrom($config->from);
            $mail->addAddress($toEmail);               
            
            $mail->isHTML($html);                                  
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            
            $data->success = true;
        } catch (Exception $e) {
            $data->message = $mail->ErrorInfo;

            $data->success = false;
        }

        return $data;
    }

}
