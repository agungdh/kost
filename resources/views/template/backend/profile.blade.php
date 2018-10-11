@extends('template.backend.template')

@section('nav')
<li><a href="{{ route('dashboard') }}">Home</a></li>
<li><a href="{{ route('profile') }}">Profil</a></li>
@endsection

@section('content')
<div class="row clearfix">
    <div class="card">
        <div class="header">
            <h2>
                PROFIL
            </h2>
        </div>
        <div class="body">
            {!! Form::model($user, ['route' => 'doProfile', 'method' => 'put']) !!}

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
                
                @php
                if($user->verified_nohp == 'y') {
                  $title = 'Verified';
                  $icon = '&#10003;';
                } else {
                  $title = 'Unverified';
                  $icon = '?';
                }
                @endphp
                <label for="nohp">No HP<label data-toggle="tooltip" data-placement="top" title="{{ $title }}">({!! $icon !!})</label></label>
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