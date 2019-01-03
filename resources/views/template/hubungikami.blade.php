@extends('template.frontend.template')

@section('nav')
<li><a href="{{ route('root') }}">Home</a></li>
<li><a href="{{ route('hubungiKami') }}">Hubungi Kami</a></li>
@endsection

@section('content')
<div class="row clearfix">
  <div class="card">
      <div class="header">
          <h2>
              HUBUNGI KAMI
          </h2>
      </div>
      <div class="body">
        <p class="lead">
            Keep in touch
        </p>
        <p>
            Anda dapat menghubungi kami melalui email: admin@nyarikos.online
        </p>
        <p>
          Anda juga dapat menghubugi kami melalui telpon/WA: 0812-3456-7890
        </p>
        <p>Jika anda ingin berkunjung, anda bisa menuju ke <a target="_blank" href="https://www.google.com/maps/search/-5.358433,105.232455">Jl. Soekarno Hatta No.10, Rajabasa Raya, Rajabasa, Kota Bandar Lampung, Lampung 35141</a></p>
    </div>
  </div>
</div>
@endsection