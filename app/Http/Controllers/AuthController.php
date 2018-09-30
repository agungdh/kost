<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AuthController extends Controller
{
    public function login()
    {
    	return view('template.login');
    }

    public function doLogin(Request $request)
    {
    	$user = DB::table('user')
			    		->where('email', $request->email)
			    		->first();

		if ($user != null) {
			if (Hash::check($request->password, $user->password)) {
				session([
					'id' => $user->id,
					'email' => $user->email,
                    'nama' => $user->nama,
                    'alamat' => $user->alamat,
                    'id_desa' => $user->id_desa,
					'nohp' => $user->nohp,
                    'level' => $user->level,
                    'active' => $user->active,
					'token' => $user->token,
					'login' => true
				]);

				return redirect()->route('root');
			}
		}

		return redirect()->
                    route('login')
                    ->with('email', $request->email)
                    ->with('alert', [
                        'title' => 'ERROR !!!',
                        'message' => 'Login Gagal !!!',
                        'class' => 'error',
                    ]);
    }

    public function register()
    {
        return view('template.register');
    }

    public function doRegister(Request $request)
    {
    	$request->validate([
            'email' => 'required|unique:user,email|email',
            'password' => 'required|confirmed',
            'nama' => 'required',
            'alamat' => 'required',
            'nohp' => 'required',
        ]);
    }

    public function account()
    {
    	// 
    }

    public function chAccount()
    {
    	// 
    }

    public function chpassAccount()
    {
        // 
    }

    public function forgetPassword()
    {
        // 
    }

    public function doForgetPassword()
    {
    	$this->sendSMTPMail('agungdh@live.com', 'ini test pada waktu ' . date('d-m-Y H:i:s'), view('errors.404')->render());
    }

    public function forgetPasswordChpass()
    {
        // 
    }

    public function doForgetPasswordChpass()
    {
        // 
    }

    public function doLogout()
    {
    	session()->flush();

    	return redirect()->route('root');
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

}
