<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;

class AuthController extends Controller
{
    public function login()
    {
    	return view('template/login');
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
					'password' => $user->password,
					'nama' => $user->nama,
                    'level' => $user->level,
                    'id_pemilik_kos' => $user->id_pemilik_kos,
                    'active' => $user->active,
					'token' => $user->token,
					'login' => true
				]);

				return redirect()->route('root');
			}
		}

		return redirect()->route('login')->with('input', ['email' => $request->email, 'password' => $request->password]);
    }

    public function register()
    {
    	// 
    }

    public function doRegister()
    {
    	// 
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
    	// 
    }

    public function forgetPasswordChpass()
    {
        // 
    }

    public function doForgetPasswordChpass()
    {
        // 
    }

    private function sendSMTPMail($server, $encryption, $email, $password, $port, $toEmail, $subject, $body, $html = TRUE)
    {
        $data = new \stdClass();

        $mail = new PHPMailer(true);                              
        try {
            $mail->isSMTP();                                      
            $mail->Host = $server;  
            $mail->SMTPOptions = [ 'ssl' => [
                                     'verify_peer' => false,
                                     'verify_peer_name' => false,
                                     'allow_self_signed' => true
                                    ]
                                ];
            $mail->SMTPAuth = true;                               
            $mail->Username = $email;                 
            $mail->Password = $password;                           
            $mail->SMTPSecure = $encryption;                            
            $mail->Port = $port;                                    

            $mail->setFrom($email);
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

    public function doLogout()
    {
    	session()->flush();

    	return redirect()->route('root');
    }

}
