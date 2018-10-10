@extends('template.backend.template')

@section('nav')
@include('backend.user.nav')
<li><a href="{{ route('user.profile', $user->id) }}">Profil</a></li>
@endsection

@section('content')
<div class="row clearfix">
    <div class="card">
        <div class="header">
            <h2>
                PROFIL
            </h2>
        </div>
        <div class="body">
            {!! Form::model($user, ['route' => ['user.doProfile', $user->id], 'method' => 'put']) !!}

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

                <label for="level">Level</label>
                <div class="form-group">
                    @php
                    $class = $errors->has('level') ? 'form-line error focused' : 'form-line';
                    $message = $errors->has('level') ? '<label class="error">' . $errors->first('level') . '</label>' : '';
                    @endphp
                    <div class="{{ $class }}">
                        {!!
                          Form::select(
                            'level',
                            [
                                'a' => 'Admin',
                                'p' => 'Pemilik Kos',
                            ],
                            null,
                            [
                              'class'=> 'form-control',
                              'id'=>'level',
                              'placeholder' => 'Pilih Level',
                            ])
                        !!}
                    </div>
                    {!! $message !!}
                </div>
                
                <label for="active">Status</label>
                <div class="form-group">
                    @php
                    $class = $errors->has('active') ? 'form-line error focused' : 'form-line';
                    $message = $errors->has('active') ? '<label class="error">' . $errors->first('active') . '</label>' : '';
                    @endphp
                    <div class="{{ $class }}">
                        {!!
                          Form::select(
                            'active',
                            [
                                'y' => 'Aktif',
                                'n' => 'Belum Aktif',
                            ],
                            null,
                            [
                              'class'=> 'form-control',
                              'id'=>'active',
                              'placeholder' => 'Pilih Status',
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