@extends('template.frontend.template')

@section('nav')
<li><a href="{{ route('root') }}">Home</a></li>
@endsection

@section('content')
<div class="row clearfix">
  <div class="card">
      <div class="header">
          <h2>
              HOME
          </h2>
      </div>
      <div class="body">
        {!! Form::model($inputs, ['route' => 'root', 'method' => 'get']) !!}

            {!!
                Form::adhSelect2(
                    'Tipe',
                    'tipe', 
                    [
                      'l' => 'Laki - Laki',
                      'p' => 'Perempuan',
                      'lp' => 'Campur',
                    ], 
                    null, 
                    []
                )
            !!}
            
            {!!
                Form::adhSelect2(
                    'Bulanan / Tahunan',
                    'waktupembayaran', 
                    [
                      'b' => 'Bulanan',
                      't' => 'Tahunan',
                    ], 
                    null, 
                    []
                )
            !!}

            <button type="submit" class="btn btn-success waves-effect">SIMPAN</button>
            <a href="{{ route('kos.index') }}" class="btn btn-primary waves-effect">BATAL</a>

        {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection