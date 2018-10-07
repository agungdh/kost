@extends('template.backend.template')

@section('nav')
@include('backend.kost.nav')
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
            {!! Form::open(['route' => 'doProfile']) !!}
            @method('put')

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
                
                <label for="prop">Provinsi</label>
                <div class="form-group">
                    @php
                    $class = $errors->has('prop') ? 'form-line error focused' : 'form-line';
                    $message = $errors->has('prop') ? '<label class="error">' . $errors->first('prop') . '</label>' : '';
                    @endphp
                    <div class="{{ $class }}">
                        {!!
                          Form::select(
                            'prop',
                            [],
                            null,
                            [
                              'class'=> 'form-control show-tick',
                              'id'=>'prop',
                              'data-live-search' => 'true',
                            ])
                        !!}
                    </div>
                    {!! $message !!}
                </div>
                
                <label for="kab">Kabupaten</label>
                <div class="form-group">
                    @php
                    $class = $errors->has('kab') ? 'form-line error focused' : 'form-line';
                    $message = $errors->has('kab') ? '<label class="error">' . $errors->first('kab') . '</label>' : '';
                    @endphp
                    <div class="{{ $class }}">
                        {!!
                          Form::select(
                            'kab',
                            [],
                            null,
                            [
                              'class'=> 'form-control show-tick',
                              'id'=>'kab',
                              'data-live-search' => 'true',
                              'disabled' => 'true',
                            ])
                        !!}
                    </div>
                    {!! $message !!}
                </div>
                
                <label for="kec">Kecamatan</label>
                <div class="form-group">
                    @php
                    $class = $errors->has('kec') ? 'form-line error focused' : 'form-line';
                    $message = $errors->has('kec') ? '<label class="error">' . $errors->first('kec') . '</label>' : '';
                    @endphp
                    <div class="{{ $class }}">
                        {!!
                          Form::select(
                            'kec',
                            [],
                            null,
                            [
                              'class'=> 'form-control show-tick',
                              'id'=>'kec',
                              'data-live-search' => 'true',
                              'disabled' => 'true',
                            ])
                        !!}
                    </div>
                    {!! $message !!}
                </div>
                
                <label for="desa">Kelurahan</label>
                <div class="form-group">
                    @php
                    $class = $errors->has('desa') ? 'form-line error focused' : 'form-line';
                    $message = $errors->has('desa') ? '<label class="error">' . $errors->first('desa') . '</label>' : '';
                    @endphp
                    <div class="{{ $class }}">
                        {!!
                          Form::select(
                            'desa',
                            [],
                            null,
                            [
                              'class'=> 'form-control show-tick',
                              'id'=>'desa',
                              'data-live-search' => 'true',
                              'disabled' => 'true',
                            ])
                        !!}
                    </div>
                    {!! $message !!}
                </div>
                
                <button type="submit" class="btn btn-success waves-effect">SIMPAN</button>
                <a href="{{ route('kost.index') }}" class="btn btn-primary waves-effect">BATAL</a>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('js')
{{-- onload --}}
<script type="text/javascript">
  
</script>

{{-- funcions --}}
<script type="text/javascript">
  $("#prop").change(function() {

  });
</script>
@endsection