@extends('template.logtemplate')

@section('body')
{!! Form::open(['route' => 'doLogin']) !!}
    <div class="msg">Sign in to start your session{{ session('test') }}</div>
    <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">email</i>
        </span>
        <div class="form-line">
            {!!
                Form::text(
                    'email', 
                    session('email'), 
                    [
                        'class'=> 'form-control', 
                        'id' => 'email', 
                        'placeholder'=>'Email',
                        'required'=>'required',
                    ])
            !!}
        </div>
    </div>
    <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">lock</i>
        </span>
        <div class="form-line">
            {!!
                Form::password(
                    'password',  
                    [
                        'class'=> 'form-control', 
                        'id' => 'password', 
                        'placeholder'=>'Password',
                        'required'=>'required',
                    ])
            !!}
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <button class="btn btn-block bg-pink waves-effect" type="submit">LOGIN</button>
        </div>
    </div>
    <div class="row m-t-15 m-b--20">
        <div class="col-xs-6">
            <a href="{{ route('register') }}">Register Now!</a>
        </div>
        <div class="col-xs-6 align-right">
            <a href="forgot-password.html">Forgot Password?</a>
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