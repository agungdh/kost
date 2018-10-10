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

                <label for="newpassword">Password Baru</label>
                <div class="form-group">
                    @php
                    $class = $errors->has('newpassword') ? 'form-line error focused' : 'form-line';
                    $message = $errors->has('newpassword') ? '<label class="error">' . $errors->first('newpassword') . '</label>' : '';
                    @endphp
                    <div class="{{ $class }}">
                        {!!
                            Form::password(
                                'newpassword', 
                                [
                                    'class'=> 'form-control', 
                                    'id' => 'newpassword', 
                                    'placeholder'=>'Password Baru',
                                ])
                        !!}
                    </div>
                    {!! $message !!}
                </div>

                <label for="newpassword_confirmation">Ulangi Password Baru</label>
                <div class="form-group">
                    @php
                    $class = $errors->has('newpassword') ? 'form-line error focused' : 'form-line';
                    $message = $errors->has('newpassword') ? '<label class="error">' . $errors->first('newpassword') . '</label>' : '';
                    @endphp
                    <div class="{{ $class }}">
                        {!!
                            Form::password(
                                'newpassword_confirmation', 
                                [
                                    'class'=> 'form-control', 
                                    'id' => 'newpassword_confirmation', 
                                    'placeholder'=>'Ulangi Password Baru',
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