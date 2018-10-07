<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h3>Ubah Email</h3>

	<p>Silahkan konfirmasi ubah email akun anda : <a target="_blank" href="{{ route('confirmChemail') }}?head={{ md5($user->id) }}&body={{ md5($user->email) }}&token={{ $token }}&key={{ md5($temp_email) }}">Klik Disini untuk ubah email</a></p>
</body>
</html>