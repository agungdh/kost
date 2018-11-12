@extends('template.backend.template')

@section('nav')
@include('backend.user.nav')
<li><a href="{{ route('user.foto', $user->id) }}">Foto</a></li>
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
            {!! Form::model($user, ['route' => ['user.doFoto', $user->id], 'files' => true, 'method' => 'put']) !!}

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
                                    'disabled'=>'true',
                                ])
                        !!}
                    </div>
                    {!! $message !!}
                </div>

                <label for="email">Email</label>
                <div class="form-group">
                    @php
                    $class = $errors->has('email') ? 'form-line error focused' : 'form-line';
                    $message = $errors->has('email') ? '<label class="error">' . $errors->first('email') . '</label>' : '';
                    @endphp
                    <div class="{{ $class }}">
                        {!!
                            Form::text(
                                'email', 
                                null, 
                                [
                                    'class'=> 'form-control', 
                                    'id' => 'email', 
                                    'placeholder'=>'Email',
                                    'disabled'=>'true',
                                ])
                        !!}
                    </div>
                    {!! $message !!}
                </div>

                @php
                if (file_exists(storage_path('app/public/profilephoto/' . $user->id))) {
                    $url = asset('storage/profilephoto/' . $user->id);
                } else {
                    $url = asset('assets/img/sorry-no-image-available.png');
                }
                @endphp
                <div class="user-info">
                    <div class="image">
                        <a href="{{ $url }}" target="_blank">
                            <img src="{{ $url }}" width="48" height="48">
                        </a>
                    </div>
                </div>

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
                <a href="{{ route('user.index') }}" class="btn btn-primary waves-effect">BATAL</a>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection