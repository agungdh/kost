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
                
                <button type="submit" class="btn btn-success waves-effect">SIMPAN</button>
                <a href="{{ route('dashboard') }}" class="btn btn-primary waves-effect">BATAL</a>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection