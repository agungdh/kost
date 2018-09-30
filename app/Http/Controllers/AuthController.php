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
                if ($user->active == 'y') {
    				session([
    					'id' => $user->id,
    					'email' => $user->email,
                        'nama' => $user->nama,
                        'alamat' => $user->alamat,
    					'nohp' => $user->nohp,
                        'level' => $user->level,
                        'active' => $user->active,
    					'token' => $user->token,
    					'login' => true
    				]);

    				return redirect()->route('root');                    
                } else {

                }
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

        $data = $request->only('email','password','nama','alamat','nohp');
        $data['password'] = Hash::make($data['password']);
        $data['level'] = 'p';
        $data['active'] = 'n';
        $data['token'] = bin2hex(random_bytes(16));

        $insertId = DB::table('user')
            ->insertGetId($data);

        $html = view('template.emailaktivasi', [
                                            'id' => md5($insertId),
                                            'email' => md5($data['email']),
                                            'token' => $data['token'],
                                        ])->render();

        $this->sendSMTPMail($data['email'], 'Aktivasi akun anda', $html);

        return redirect()
                    ->route('login')
                    ->with('alert', [
                        'title' => 'SUCCESS !!!',
                        'message' => 'Pendaftaran berhasil, silakan cek email untuk konfirmasi email.',
                        'class' => 'success',
                    ]);
    }

    public function activate(Request $request)
    {
        $user = DB::table('user')
                ->where('token', $request->token)
                ->first();

        if ($user) {
            if (md5($user->id) == $request->head && md5($user->email) == $request->body) {
                DB::table('user')
                    ->where('id', $user->id)
                    ->update([
                        'active' => 'y',
                        'token' => null,
                    ]);

                return redirect()
                        ->route('login')
                        ->with('alert', [
                            'title' => 'SUCCESS !!!',
                            'message' => 'Aktivasi berhasil !!!',
                            'class' => 'success',
                        ]);
            }
        }

        return redirect()->route('root');
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
