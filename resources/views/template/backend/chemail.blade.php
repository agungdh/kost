@extends('template.backend.template')

@section('nav')
<li><a href="{{ route('dashboard') }}">Home</a></li>
<li><a href="{{ route('chpass') }}">Ubah Password</a></li>
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
            {!! Form::open(['route' => 'doChpass']) !!}
            @method('put')

                <label for="oldpassword">Password Lama</label>
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
                                    'placeholder'=>'Password Lama',
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
                <a href="{{ route('dashboard') }}" class="btn btn-primary waves-effect">BATAL</a>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection