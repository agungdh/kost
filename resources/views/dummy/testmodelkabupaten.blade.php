<!DOCTYPE html>
<html>
<head>
	<title>Test Model Kabupaten</title>
</head>
<body>
	<table border="1">
		<tr>
			<td>{{ $kabupaten->provinsi->id }}</td>
			<td>{{ ucwords(strtolower($kabupaten->provinsi->nama_prop)) }}</td>
			<td colspan="3">Kabupaten</td>
		</tr>
		<tr>
			<td></td>
			<td>{{ $kabupaten->id }}</td>
			<td>{{ ucwords(strtolower($kabupaten->nama_kab)) }}</td>
			<td colspan="2">Kecamatan</td>
		</tr>
		@foreach($kabupaten->kecamatans as $kecamatan)
			<tr>
				<td colspan="2"></td>
				<td>{{ $kecamatan->id }}</td>
				<td>{{ ucwords(strtolower($kecamatan->nama_kec)) }}</td>
				<td>Kelurahan</td>
			</tr>
			@foreach($kecamatan->kelurahans as $kelurahan)
			<tr>
				<td colspan="3"></td>
				<td>{{ $kelurahan->id }}</td>
				<td>{{ ucwords(strtolower($kelurahan->nama_desa)) }}</td>
			</tr>
			@endforeach
		@endforeach
	</table>
</body>
</html>