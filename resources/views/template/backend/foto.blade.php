@extends('template.backend.template')

@section('nav')
<li><a href="{{ route('dashboard') }}">Home</a></li>
<li><a href="{{ route('foto') }}">Foto</a></li>
@endsection

@section('content')
<div class="row clearfix">
    <div class="card">
        <div class="header">
            <h2>
                FOTO
            </h2>
        </div>
        <div class="body">
            {!! Form::open(['route' => 'doFoto', 'files' => true, 'method' => 'put']) !!}

                <label for="foto">Foto</label>
                <div class="form-group">
                    @php
                    $class = $errors->has('foto') ? 'form-line error focused' : 'form-line';
                    $message = $errors->has('foto') ? '<label class="error">' . $errors->first('foto') . '</label>' : '';
                    @endphp
                    <div class="{{ $class }}">
                        {!!
                            Form::file(
                                'foto',  
                                [
                                    'class'=> 'form-control', 
                                    'id' => 'foto', 
                                    'placeholder'=>'Foto',
                                ])
                        !!}
                    </div>
                    {!! $message !!}
                </div>
                 
                <button type="submit" class="btn btn-success waves-effect">SIMPAN</button>
                <a href="{{ route('dashboard') }}" class="btn btn-primary waves-effect">BATAL</a>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection