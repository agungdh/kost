<!DOCTYPE html>
<html>
<head>
	<title>Test Model Kecamatan</title>
</head>
<body>
	<table border="1">
		<tr>
			<td>{{ $kecamatan->kabupaten->provinsi->id }}</td>
			<td>{{ ucwords(strtolower($kecamatan->kabupaten->provinsi->nama_prop)) }}</td>
			<td colspan="3">Kabupaten</td>
		</tr>
		<tr>
			<td></td>
			<td>{{ $kecamatan->kabupaten->id }}</td>
			<td>{{ ucwords(strtolower($kecamatan->kabupaten->nama_kab)) }}</td>
			<td colspan="2">Kecamatan</td>
		</tr>
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
	</table>
</body>
</html>