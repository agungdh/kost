<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h3>Reset Password</h3>

	<p>Silahkan reset password akun anda : <a target="_blank" href="{{ route('forgetPasswordChPass') }}?head={{ md5($user->id) }}&body={{ md5($user->email) }}&token={{ $token }}">Klik Disini untuk reset password</a></p>
</body>
</html>