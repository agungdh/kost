<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;

use App\Helpers\adhMail;

use App\User;
class AuthController extends Controller
{
    var $adhMail;

    public function __construct()
    {
        $this->adhMail = new adhMail();
    }

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

    	$user = User::where('email', $request->email)->first();

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

    				return redirect()->route('dashboard');                    
                } else {
                    return view('template.backend.butuhkonfirmasi')->with('user', $user);
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
            'tipe' => 'required',
            'email' => 'required|unique:user,email|email',
            'password' => 'required|confirmed',
            'nama' => 'required',
            'alamat' => 'required',
            'nohp' => 'required',
        ]);

        $data = $request->only('email','password','nama','alamat','nohp');
        $data['level'] = $request->tipe;
        $data['password'] = Hash::make($data['password']);
        $data['active'] = 'n';
        $data['token'] = bin2hex(random_bytes(16));
        $data['verified_nohp'] = 'n';

        $user = User::create($data);

        $html = view('template.email.aktivasi', [
                                            'id' => md5($user->id),
                                            'email' => md5($data['email']),
                                            'token' => $data['token'],
                                        ])->render();

        $this->adhMail->mail($data['email'], 'Aktivasi akun anda', $html);

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
        $user = User::where('token', $request->token)->first();

        if ($user) {
            if (md5($user->id) == $request->head && md5($user->email) == $request->body) {
                User::where('id', $user->id)
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

        $this->adhMail->mail($request->email, 'Aktivasi akun anda', $html);

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

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('root');   
        }

        $token = bin2hex(random_bytes(16));

        User::where('id', $user->id)->update([
                    'token' => $token,
                ]);

        $html = view('template.email.lupapassword')
                    ->with('user', $user)
                    ->with('token', $token)
                    ->render();

        $this->adhMail->mail($user->email, 'Reset Password', $html);

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
        $user = User::where('token', $request->token)->first();

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

        $user = User::where('token', $request->token)
                ->first();

        if ($user) {
            if (md5($user->id) == $request->head && md5($user->email) == $request->body) {
                User::where('id', $user->id)->update([
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

    	return redirect()->route('login');
    }

}
