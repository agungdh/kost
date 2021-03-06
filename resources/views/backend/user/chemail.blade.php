@extends('template.backend.template')

@section('nav')
@include('backend.user.nav')
<li><a href="{{ route('user.chemail', $user->id) }}">Ubah Email</a></li>
@endsection

@section('content')
<div class="row clearfix">
    <div class="card">
        @adhHeader([
            'title' => 'UBAH EMAIL',
          ])
        @endadhHeader
        <div class="body">
            {!! Form::model($user, ['route' => ['user.doChemail', $user->id], 'method' => 'put']) !!}

                @include('backend.user.emailnama')

               {!!
                    Form::adhText(
                        'Email Baru',
                        'newemail',  
                        true, 
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