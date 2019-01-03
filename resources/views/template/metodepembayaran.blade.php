@extends('template.frontend.template')

@section('nav')
<li><a href="{{ route('root') }}">Home</a></li>
<li><a href="{{ route('metodePembayaran') }}">Metode Pembayaran</a></li>
@endsection

@section('content')
<div class="row clearfix">
  <div class="card">
      <div class="header">
          <h2>
              METODE PEMBAYARAN
          </h2>
      </div>
      <div class="body">
        <p class="lead">
            Fleksibel, bisa transfer dan bisa COD
        </p>
        <p>
            Anda dapat melakukan pembayaran melalui transfer bank ke:
            <br>Bank BRI
            <br>No Rek: 1234-5678-90
            <br>Atas Nama: PT. Nyari Kos Online, Tbk.
        </p>
        <p>Atau anda juga dapat melakukan pembayaran dengan metode COD dengan cara <a href="{{route('hubungiKami')}}">menghubungi kami</a> terlebih dahulu dan mendiskusikan waktu dan tempat untuk melakukan COD.</p>
    </div>
  </div>
</div>
@endsection