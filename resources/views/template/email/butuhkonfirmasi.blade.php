<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<title></title>

	<script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/plugins/jquery/jquery.min.js"></script>
	<script type="text/javascript">
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	</script>
</head>
<body>
	<div id="main">
		<h3>Email belum dikonfirmasi</h3>

		<p>Silakan cek inbox / spam. atau <a href="javascript:void(0)" onclick="reactivate()">Klik Disini untuk kirim ulang aktivasi</a></p>

		<p><a href="{{ route('root') }}">Klik disini untuk kembali</a></p>
	</div>

	<div id="progress" style="display: none;">
		<p>Sedang mengirim email. Silakan tunggu...</p>
		<p><a href="{{ route('root') }}">Klik disini untuk kembali</a></p>
	</div>
</body>
<script type="text/javascript">
	function reactivate() {
		$('#main').attr('style', 'display: none');
		$('#progress').attr('style', 'display: all');

		$.ajax({
		  type: "POST",
		  url: "{{ route('resendActivate') }}",
		  data: {
		  	'head' : "{{ md5($user->id) }}",
		  	'body' : "{{ md5($user->email) }}",
		  	'token' : "{{ $user->token }}",
		  	'email' : "{{ $user->email }}",
		  },
		  success: function(response) {
		  	window.location = "{{ route('successResendActivate') }}";
		  },
		  error: function() {
		  	window.location = "{{ route('root') }}";
		  }
		});
	}
</script>
</html>