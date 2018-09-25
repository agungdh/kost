<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<form action="{{ route('doLogin') }}" method="POST">
		@csrf

		<label>Username</label>
		@if(session('input'))
		<input type="text" name="username" id="username" value="{{ session('input')['username'] }}">
		@else
		<input type="text" name="username" id="username">
		@endif
		<br>

		<label>Password</label>
		<input type="password" name="password" id="password">
		<br>

		<input type="submit" value="Login">
	</form>
</body>
</html>