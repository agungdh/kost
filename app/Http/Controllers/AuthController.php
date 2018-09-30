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
    	return view('template.log.login');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

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
                    return view('template.email.butuhkonfirmasi')->with('user', $user);
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
        return view('template.log.register');
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

        $html = view('template.email.aktivasi', [
                                            'id' => md5($insertId),
                                            'email' => md5($data['email']),
                                            'token' => $data['token'],
                                        ])->render();

        $this->mail($data['email'], 'Aktivasi akun anda', $html);

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

    public function resendActivate(Request $request)
    {
        $html = view('template.email.aktivasi', [
                                            'id' => $request->head,
                                            'email' => $request->body,
                                            'token' => $request->token,
                                        ])->render();

        $this->mail($request->email, 'Aktivasi akun anda', $html);

        return json_encode(TRUE);
    }

    public function successResendActivate()
    {
        return redirect()
                    ->route('login')
                    ->with('alert', [
                        'title' => 'SUCCESS !!!',
                        'message' => 'silakan cek email untuk konfirmasi email.',
                        'class' => 'success',
                    ]);
    }

    public function forgetPassword()
    {
        return view('template.log.forgetpassword');
    }

    public function doForgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = DB::table('user')
                    ->where('email', $request->email)
                    ->first();

        if (!$user) {
            return redirect()->route('root');   
        }

        $token = bin2hex(random_bytes(16));

        DB::table('user')
                ->where('id', $user->id)
                ->update([
                    'token' => $token,
                ]);

        $html = view('template.email.lupapassword')
                    ->with('user', $user)
                    ->with('token', $token)
                    ->render();

        $this->mail($user->email, 'Reset Password', $html);

        return redirect()
                    ->route('login')
                    ->with('alert', [
                        'title' => 'SUCCESS !!!',
                        'message' => 'Silakan cek email untuk reset password.',
                        'class' => 'success',
                    ]);
    }

    public function forgetPasswordChPass(Request $request)
    {
        $user = DB::table('user')
                ->where('token', $request->token)
                ->first();

        if ($user) {
            if (md5($user->id) == $request->head && md5($user->email) == $request->body) {
                return view('template.log.forgetpasswordchpass')
                            ->with('user', $user)
                            ->with('head', $request->head)
                            ->with('body', $request->body)
                            ->with('token', $request->token);
            }
        }

        return redirect()->route('root');
    }

    public function doForgetPasswordChPass(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
        ]);

        $user = DB::table('user')
                ->where('token', $request->token)
                ->first();

        if ($user) {
            if (md5($user->id) == $request->head && md5($user->email) == $request->body) {
                DB::table('user')
                    ->where('id', $user->id)
                    ->update([
                        'password' => Hash::make($request->password),
                        'active' => 'y',
                        'token' => null,
                    ]);

                return redirect()
                        ->route('login')
                        ->with('alert', [
                            'title' => 'SUCCESS !!!',
                            'message' => 'Berhasil ganti password !!!',
                            'class' => 'success',
                        ]);
            }
        }

        return redirect()->route('root');
    }

    public function doLogout()
    {
    	session()->flush();

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
