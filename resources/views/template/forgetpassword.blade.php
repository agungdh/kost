@extends('template.logtemplate')

@section('body')
{!! Form::open(['route' => 'doForgetPassword']) !!}
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
    <div class="row">
        <div class="col-xs-12">
            <button class="btn btn-block bg-pink waves-effect" type="submit">SEND EMAIL LINK</button>
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