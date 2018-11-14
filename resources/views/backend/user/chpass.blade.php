@extends('template.backend.template')

@section('nav')
@include('backend.user.nav')
<li><a href="{{ route('user.chpass', $user->id) }}">Ubah Password</a></li>
@endsection

@section('content')
<div class="row clearfix">
    <div class="card">
        <div class="header">
            <h2>
                UBAH PASSWORD
            </h2>
        </div>
        <div class="body">
            {!! Form::model($user, ['route' => ['user.doChpass', $user->id], 'method' => 'put']) !!}

                @include('backend.user.emailnama')

                {!!
                    Form::adhPassword(
                        'Password Baru',
                        'newpassword'
                    )
                !!}

                {!!
                    Form::adhPassword(
                        'Ulangi Password Baru',
                        'newpassword_confirmation'
                    )
                !!}

                <button type="submit" class="btn btn-success waves-effect">SIMPAN</button>
                <a href="{{ route('user.index') }}" class="btn btn-primary waves-effect">BATAL</a>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection