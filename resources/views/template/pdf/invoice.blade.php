<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
</head>
<body>
	@php
	$kost = $trx->kos;
    $pencari = $trx->userPencariKos;
    $validator = $trx->userValidator;
	@endphp
	<h3 style="text-align: center;">Invoice</h3>
	<table border="1" style="margin: auto; width: 50%">
	  <tr>
	    <td>ID Transaksi</td>
	    <td>: {{$trx->id}}</td>
	  </tr>
	  <tr>
	    <td>Nama Pembeli</td>
	    <td>: {{$pencari->nama}}</td>
	  </tr>
	  <tr>
	    <td>No HP Pembeli</td>
	    <td>: {{$pencari->nohp}}</td>
	  </tr>
	  <tr>
	    <td>Nama Kost</td>
	    <td>: {{$kost->nama}}</td>
	  </tr>
	  <tr>
	    <td>Alamat Kos</td>
	    <td>: {{$kost->alamat}}</td>
	  </tr>
	  <tr>
	    <td>Kecamatan</td>
	    <td>: {{ ucwords(strtolower($kost->kelurahan->kecamatan->nama_kec)) }}</td>
	  </tr>
	  <tr>
	    <td>Kelurahan</td>
	    <td>: {{ucwords(strtolower($kost->kelurahan->nama_desa))}}</td>
	  </tr>
	  <tr>
	    <td>Nama Pemilik</td>
	    <td>: {{$kost->user->nama}}</td>
	  </tr>
	  <tr>
	    <td>No HP Pemilik</td>
	    <td>: {{$kost->user->nohp}}</td>
	  </tr>
	  <tr>
	    <td>Tipe</td>
	    @php
	    switch ($kost->tipe) {
	      case 'l':
	        $tipe = 'Laki - Laki';
	        break;
	      
	      case 'p':
	        $tipe = 'Perempuan';
	        break;
	      
	      case 'lp':
	        $tipe = 'Campur';
	        break;
	      
	      default:
	        $tipe = 'ERROR !!!';
	        break;
	    }
	    @endphp
	    <td>: {{$tipe}}</td>
	  </tr>
	  <tr>
	    <td>Jumlah Kamar</td>
	    <td>: {{$trx->jumlah_kamar}}</td>
	  </tr>
	  <tr>
	    <td>Total Harga</td>
	    <td>: {{$pustaka->rupiah($trx->harga)}}</td>
	  </tr>
	  <tr>
	    <td>Berlaku Sampai</td>
	    @php
	    $berlakuSampai = date("d-m-Y", strtotime("+{$trx->lama_kost} years", strtotime($trx->waktu_validasi)));
	    @endphp
	    <td>: {{$berlakuSampai}}</td>
	  </tr>
	</table>
	@php
	$qrCode = new \Endroid\QrCode\QrCode(route('invoice', $trx->id));
	@endphp
	<center>
	<img width="200" height="200" src="data:image/png;base64,{{base64_encode($qrCode->writeString())}}">
	</center>
</body>
</html>