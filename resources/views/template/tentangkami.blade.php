@extends('template.frontend.template')

@section('nav')
<li><a href="{{ route('root') }}">Home</a></li>
<li><a href="{{ route('tentangKami') }}">Tentang Kami</a></li>
@endsection

@section('content')
<div class="row clearfix">
  <div class="card">
      <div class="header">
          <h2>
              TENTANG KAMI
          </h2>
      </div>
      <div class="body">
        <p class="lead">
            {{$judul}}
        </p>
        <p>
            Nyarikos.online adalah marketplace yang menghubungkan pemilik kos dan pencari kos. Dengan adanya Nyarikos.online ini, diharapkan dapat membantu para pencari kos yang ingin mencari kos tetapi tidak tahu dimana mencarinya.
        </p>
    </div>
  </div>
</div>
@endsection