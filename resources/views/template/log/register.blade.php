@extends('template.log.template')

@section('body')
{!! Form::open(['route' => 'doRegister']) !!}
    <div class="msg">Sign in to start your session</div>

    <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">email</i>
        </span>
        @php
        $class = $errors->has('email') ? 'form-line error focused' : 'form-line';
        $message = $errors->has('email') ? '<label class="error">' . $errors->first('email') . '</label>' : '';
        @endphp
        <div class="{{ $class }}">
            {!!
                Form::text(
                    'email', 
                    session('email'), 
                    [
                        'class'=> 'form-control', 
                        'id' => 'email', 
                        'placeholder'=>'Email',
                    ])
            !!}
        </div>
        {!! $message !!}
    </div>

    <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">lock</i>
        </span>
        @php
        $class = $errors->has('password') ? 'form-line error focused' : 'form-line';
        $message = $errors->has('password') ? '<label class="error">' . $errors->first('password') . '</label>' : '';
        @endphp
        <div class="{{ $class }}">
            {!!
                Form::password(
                    'password',  
                    [
                        'class'=> 'form-control', 
                        'id' => 'password', 
                        'placeholder'=>'Password',
                    ])
            !!}
        </div>
        {!! $message !!}
    </div>

    <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">lock</i>
        </span>
        @php
        $class = $errors->has('password') ? 'form-line error focused' : 'form-line';
        $message = $errors->has('password') ? '<label class="error">' . $errors->first('password') . '</label>' : '';
        @endphp
        <div class="{{ $class }}">
            {!!
                Form::password(
                    'password_confirmation',  
                    [
                        'class'=> 'form-control', 
                        'id' => 'password_confirmation', 
                        'placeholder'=>'Password Confirmation',
                    ])
            !!}
        </div>
        {!! $message !!}
    </div>

    <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">person</i>
        </span>
        @php
        $class = $errors->has('nama') ? 'form-line error focused' : 'form-line';
        $message = $errors->has('nama') ? '<label class="error">' . $errors->first('nama') . '</label>' : '';
        @endphp
        <div class="{{ $class }}">
            {!!
                Form::text(
                    'nama', 
                    session('nama'), 
                    [
                        'class'=> 'form-control', 
                        'id' => 'nama', 
                        'placeholder'=>'Nama',
                    ])
            !!}
        </div>
        {!! $message !!}
    </div>

    <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">place</i>
        </span>
        @php
        $class = $errors->has('alamat') ? 'form-line error focused' : 'form-line';
        $message = $errors->has('alamat') ? '<label class="error">' . $errors->first('alamat') . '</label>' : '';
        @endphp
        <div class="{{ $class }}">
            {!!
                Form::text(
                    'alamat', 
                    session('alamat'), 
                    [
                        'class'=> 'form-control', 
                        'id' => 'alamat', 
                        'placeholder'=>'Alamat',
                    ])
            !!}
        </div>
        {!! $message !!}
    </div>

    <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">contact_phone</i>
        </span>
        @php
        $class = $errors->has('nohp') ? 'form-line error focused' : 'form-line';
        $message = $errors->has('nohp') ? '<label class="error">' . $errors->first('nohp') . '</label>' : '';
        @endphp
        <div class="{{ $class }}">
            {!!
                Form::text(
                    'nohp', 
                    session('nohp'), 
                    [
                        'class'=> 'form-control', 
                        'id' => 'nohp', 
                        'placeholder'=>'No HP',
                    ])
            !!}
        </div>
        {!! $message !!}
    </div>

    <div class="row">
        <div class="col-xs-12">
            <button class="btn btn-block bg-pink waves-effect" type="submit">REGISTER</button>
        </div>
    </div>
    <div class="row m-t-15 m-b--20">
        <div class="col-xs-6">
            <a href="{{ route('login') }}">Login</a>
        </div>
        <div class="col-xs-6 align-right">
            <a href="{{ route('forgetPassword') }}">Forgot Password?</a>
        </div>
    </div>
{!! Form::close() !!}

@endsection

@section('js')
@if(session('alert'))
<script type="text/javascript">
    swal('{{ session('alert')['title'] }}', '{{ session('alert')['message'] }}', '{{ session('alert')['class'] }}');
</script>
@endif
@endsection