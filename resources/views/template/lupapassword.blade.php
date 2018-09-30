<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h3>Aktivasi E-Mail</h3>

	<p>Silahkan aktivasi akun anda : <a target="_blank" href="{{ route('forgetPasswordChPass') }}?head={{ md5($user->id) }}&body={{ md5($user->email) }}&token={{ $token }}">Klik Disini untuk aktivasi</a></p>
</body>
</html>