@extends('template.frontend.template')

@section('nav')
<li><a href="{{ route('root') }}">Cari Kost</a></li>
@endsection

@section('content')
<div class="row clearfix">

    <div class="card col-md-12">
      <div class="header">
          <h2>
              HOME
          </h2>
      </div>
    </div>

    @foreach($kosts as $kost)
    <div class="card col-md-12">
      <div class="body">
          <p>Nama : {{$kost->nama}}</p>
          <p>Alamat : {{$kost->alamat}}</p>
          <p>Biaya : {{$kost->tahunan}}</p>
          <p>Deskripsi : </p>
          <hr>
          {!!$kost->deskripsi!!}
          <hr>
          <br>
          <p>
            <a target="_blank" href="https://www.google.com/maps/search/{{ $kost->latitude }},{{ $kost->longitude }}">
              <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Google Maps">
                <i class="material-icons">place</i>
              </button>
            </a>

            <a href="{{route('pesan', $kost->id)}}">
              <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Pesan">
                <i class="material-icons">shopping_cart</i>
              </button>
            </a>
          </p>
      </div>
    </div>
    @endforeach

</div>
@endsection