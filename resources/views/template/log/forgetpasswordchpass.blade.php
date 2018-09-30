@extends('template.log.template')

@section('body')
{!! Form::open(['route' => 'doForgetPasswordChPass']) !!}
    <div class="msg">Sign in to start your session</div>

    {!! Form::hidden('head', $head) !!}

    {!! Form::hidden('body', $body) !!}

    {!! Form::hidden('token', $token) !!}

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
                    $user->email, 
                    [
                        'class'=> 'form-control', 
                        'id' => 'email', 
                        'placeholder'=>'Email',
                        'readonly'=>'readonly',
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

    <div class="row">
        <div class="col-xs-12">
            <button class="btn btn-block bg-pink waves-effect" type="submit">RESET PASSWORD</button>
        </div>
    </div>
    <div class="row m-t-15 m-b--20">
        <div class="col-xs-6">
            <a href="{{ route('register') }}">Register Now!</a>
        </div>
        <div class="col-xs-6 align-right">
            <a href="{{ route('login') }}">Login</a>
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