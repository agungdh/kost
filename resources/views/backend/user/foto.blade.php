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

                @include('backend.user.emailnama')

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

                {!!
                    Form::adhFile(
                        'Foto',
                        'foto'
                    )
                !!}
                 
                <button type="submit" class="btn btn-success waves-effect">SIMPAN</button>
                <a href="{{ route('user.index') }}" class="btn btn-primary waves-effect">BATAL</a>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection