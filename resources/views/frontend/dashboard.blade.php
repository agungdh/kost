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

            <label for="tipe">Tipe</label>
            <div class="form-group">
                @php
                $class = $errors->has('tipe') ? 'form-line error focused' : 'form-line';
                $message = $errors->has('tipe') ? '<label class="error">' . $errors->first('tipe') . '</label>' : '';
                @endphp
                <div class="{{ $class }}">
                    {!!
                      Form::select(
                        'tipe',
                        [
                          'l' => 'Laki - Laki',
                          'p' => 'Perempuan',
                          'lp' => 'Campur',
                        ],
                        null,
                        [
                          'class'=> 'form-control select2',
                          'id'=>'tipe',
                          'placeholder' => 'Pilih Tipe',
                        ])
                    !!}
                </div>
                {!! $message !!}
            </div>

            <label for="waktupembayaran">Bulanan / Tahunan</label>
            <div class="form-group">
                @php
                $class = $errors->has('waktupembayaran') ? 'form-line error focused' : 'form-line';
                $message = $errors->has('waktupembayaran') ? '<label class="error">' . $errors->first('waktupembayaran') . '</label>' : '';
                @endphp
                <div class="{{ $class }}">
                    {!!
                      Form::select(
                        'waktupembayaran',
                        [
                          'b' => 'Bulanan',
                          't' => 'Tahunan',
                        ],
                        null,
                        [
                          'class'=> 'form-control select2',
                          'id'=>'waktupembayaran',
                          'placeholder' => 'Bulanan / Tahunan',
                        ])
                    !!}
                </div>
                {!! $message !!}
            </div>

            <button type="submit" class="btn btn-success waves-effect">SIMPAN</button>
            <a href="{{ route('kos.index') }}" class="btn btn-primary waves-effect">BATAL</a>

        {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection