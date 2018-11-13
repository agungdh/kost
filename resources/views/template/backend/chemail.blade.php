@extends('template.backend.template')

@section('nav')
<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li><a href="{{ route('chemail') }}">Ubah Email</a></li>
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
            {!! Form::open(['route' => 'doChemail', 'method' => 'put']) !!}

                <label for="oldpassword">Password</label>
                <div class="form-group">
                    @php
                    $class = $errors->has('oldpassword') ? 'form-line error focused' : 'form-line';
                    $message = $errors->has('oldpassword') ? '<label class="error">' . $errors->first('oldpassword') . '</label>' : '';
                    @endphp
                    <div class="{{ $class }}">
                        {!!
                            Form::password(
                                'oldpassword', 
                                [
                                    'class'=> 'form-control', 
                                    'id' => 'oldpassword', 
                                    'placeholder'=>'Password',
                                ])
                        !!}
                    </div>
                    {!! $message !!}
                </div>
                
                <label for="email">Email Baru</label>
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
                                    'placeholder'=>'Email Baru',
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