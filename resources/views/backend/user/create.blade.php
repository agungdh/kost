@extends('template.backend.template')

@section('nav')
@include('backend.user.nav')
@endsection

@section('content')
<div class="row clearfix">
    <div class="card">
        <div class="header">
            <h2>
                TAMBAH USER
            </h2>
        </div>
        <div class="body">
            {!! Form::open(['route' => 'user.store']) !!}

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
                                ])
                        !!}
                    </div>
                    {!! $message !!}
                </div>
                
                <label for="password">Password</label>
                <div class="form-group">
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

                <label for="password_confirmation">Ulangi Password</label>
                <div class="form-group">
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
                                    'placeholder'=>'Ulangi Password',
                                ])
                        !!}
                    </div>
                    {!! $message !!}
                </div>

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
                                ])
                        !!}
                    </div>
                    {!! $message !!}
                </div>
                
                <label for="alamat">Alamat</label>
                <div class="form-group">
                    @php
                    $class = $errors->has('alamat') ? 'form-line error focused' : 'form-line';
                    $message = $errors->has('alamat') ? '<label class="error">' . $errors->first('alamat') . '</label>' : '';
                    @endphp
                    <div class="{{ $class }}">
                        {!!
                            Form::text(
                                'alamat', 
                                null, 
                                [
                                    'class'=> 'form-control', 
                                    'id' => 'alamat', 
                                    'placeholder'=>'Alamat',
                                ])
                        !!}
                    </div>
                    {!! $message !!}
                </div>
                
                <label for="nohp">No HP</label>
                <div class="form-group">
                    @php
                    $class = $errors->has('nohp') ? 'form-line error focused' : 'form-line';
                    $message = $errors->has('nohp') ? '<label class="error">' . $errors->first('nohp') . '</label>' : '';
                    @endphp
                    <div class="{{ $class }}">
                        {!!
                            Form::text(
                                'nohp', 
                                null, 
                                [
                                    'class'=> 'form-control', 
                                    'id' => 'nohp', 
                                    'placeholder'=>'No HP',
                                ])
                        !!}
                    </div>
                    {!! $message !!}
                </div>

                {!!
                    Form::adhSelect2(
                        'Level',
                        'level', 
                        [
                            'a' => 'Admin',
                            'p' => 'Pemilik Kos',
                            'u' => 'Pencari Kos',
                        ], 
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

@section('js')
<script type="text/javascript">
    $("#level").select2();
    $("#active").select2();
</script>
@endsection