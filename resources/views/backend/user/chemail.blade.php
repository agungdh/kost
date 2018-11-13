@extends('template.backend.template')

@section('nav')
@include('backend.user.nav')
<li><a href="{{ route('user.chemail', $user->id) }}">Ubah Email</a></li>
@endsection

@section('content')
<div class="row clearfix">
    <div class="card">
        <div class="header">
            <h2>
                UBAH EMAIL
            </h2>
        </div>
        <div class="body">
            {!! Form::model($user, ['route' => ['user.doChemail', $user->id], 'method' => 'put']) !!}

                {!!
                    Form::adhText(
                        'Nama',
                        'nama',  
                        null, 
                        [
                            'disabled'=>'true',
                        ]
                    )
                !!}

               {!!
                    Form::adhText(
                        'Email',
                        'email',  
                        null, 
                        [
                            'disabled'=>'true',
                        ]
                    )
                !!}

               {!!
                    Form::adhText(
                        'Email Baru',
                        'newemail',  
                        null, 
                        []
                    )
                !!}
                
                <button type="submit" class="btn btn-success waves-effect">SIMPAN</button>
                <a href="{{ route('user.index') }}" class="btn btn-primary waves-effect">BATAL</a>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection