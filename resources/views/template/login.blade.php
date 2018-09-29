@extends('template.logtemplate')

@php
if (session('input')) {
    $email = session('input')['email'];
} else {
    $email = '';
}
@endphp

@section('body')
<form id="sign_in" method="POST" action="{{ route('doLogin') }}">
    @csrf
    <div class="msg">Sign in to start your session</div>
    <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">person</i>
        </span>
        <div class="form-line">
            <input type="text" class="form-control" name="email" placeholder="Email" required value="{{ $email }}">
        </div>
    </div>
    <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">lock</i>
        </span>
        <div class="form-line">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
        </div>
    </div>
    <div class="row m-t-15 m-b--20">
        <div class="col-xs-6">
            <a href="sign-up.html">Register Now!</a>
        </div>
        <div class="col-xs-6 align-right">
            <a href="forgot-password.html">Forgot Password?</a>
        </div>
    </div>
</form>
@endsection