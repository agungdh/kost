@extends('template.frontend.template')

@section('nav')
<li><a href="{{ route('root') }}">Cari Kost</a></li>
@endsection

@section('content')
<div class="row clearfix">

    <div class="card col-md-12">
      <div class="header">
          <h2>
              CARI KOS
          </h2>
      </div>
      <div class="body">
        {!! Form::model($inputs, ['route' => 'root', 'method' => 'get']) !!}
          
          {!!
              Form::adhSelect2(
                  'Kecamatan',
                  'kec',
                  true,
                  $kecamatans
              )
          !!}

          <button class="btn btn-success">Cari</button>

        {!! Form::close() !!}
      </div>
    </div>

    @foreach($kosts as $kost)
    <div class="card col-md-12">
      <div class="body">

        <hr>
        {{-- media library --}}
        <div id="mediaLibrary{{ $kost->id }}">
          
          @php
          $i = 1;
          @endphp
          @foreach($kost->fotos as $foto)
            @php
            if (file_exists(storage_path('app/public/foto/kos/' . $foto->id))) {
                $url = asset('storage/foto/kos/' . $foto->id);
            } else {
                $url = asset('assets/img/sorry-no-image-available.png');
            }
            @endphp
            <a href="{{ $url }}" data-sub-html="{{ $foto->deskripsi }}">
              @if($i == 1)
              <img class="img-responsive" src="{{ $url }}">
              {{-- <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Foto">
              <i class="material-icons">photo_library</i>
              </button> --}}
              @else
              <img style="display: none;" src="{{ $url }}">
              @endif
            </a>
            @php
            $i++;
            @endphp
          @endforeach
        </div>
        <hr>

          <p>Nama : {{$kost->nama}}</p>
          <p>Alamat : {{$kost->alamat}}</p>
          <p>Biaya : {{$pustaka->rupiah($kost->tahunan)}}</p>
          <p>Deskripsi : </p>
          <hr>
          {!!$kost->deskripsi!!}
          <hr>
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

@section('js')
<script type="text/javascript">
@foreach($kosts as $kost)
$("#mediaLibrary{{ $kost->id }}").lightGallery({thumbnail: true, selector: 'a'});
@endforeach
</script>
@endsection