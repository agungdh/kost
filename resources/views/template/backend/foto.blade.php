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
            {!! Form::open(['route' => 'doFoto']) !!}
            @method('put')

                <label for="nama">Nama</label>
                <div class="form-group">
                    @php
                    $class = $errors->has('nama') ? 'form-line error focused' : 'form-line';
                    $message = $errors->has('nama') ? '<label class="error">' . $errors->first('nama') . '</label>' : '';
                    @endphp
                    <div class="{{ $class }}">
                        {!!
                            Form::text(
                                'nama', 
                                null, 
                                [
                                    'class'=> 'form-control', 
                                    'id' => 'nama', 
                                    'placeholder'=>'Nama',
                                ])
                        !!}
                    </div>
                    {!! $message !!}
                </div>
                
                <label for="alamat">Alamat</label>
                <div class="form-group">
                    @php
                    $class = $errors->has('alamat') ? 'form-line error focused' : 'form-line';
                    $message = $errors->has('alamat') ? '<label class="error">' . $errors->first('alamat') . '</label>' : '';
                    @endphp
                    <div class="{{ $class }}">
                        {!!
                            Form::text(
                                'alamat', 
                                null, 
                                [
                                    'class'=> 'form-control', 
                                    'id' => 'alamat', 
                                    'placeholder'=>'Alamat',
                                ])
                        !!}
                    </div>
                    {!! $message !!}
                </div>
                
                <label for="nohp">No HP</label>
                <div class="form-group">
                    @php
                    $class = $errors->has('nohp') ? 'form-line error focused' : 'form-line';
                    $message = $errors->has('nohp') ? '<label class="error">' . $errors->first('nohp') . '</label>' : '';
                    @endphp
                    <div class="{{ $class }}">
                        {!!
                            Form::text(
                                'nohp', 
                                null, 
                                [
                                    'class'=> 'form-control', 
                                    'id' => 'nohp', 
                                    'placeholder'=>'No HP',
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