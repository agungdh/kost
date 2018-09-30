<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h3>Aktivasi E-Mail</h3>

	<p>Silahkan aktivasi akun anda : <a target="_blank" href="{{ route('activate') }}?head={{ $id }}&body={{ $email }}&token={{ $token }}">Klik Disini untuk aktivasi</a></p>
</body>
</html>