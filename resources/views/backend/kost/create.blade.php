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
            {!! Form::open(['route' => 'kost.store']) !!}

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
                              'class'=> 'form-control',
                              'id'=>'prop',
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
                              'class'=> 'form-control',
                              'id'=>'kab',
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
                              'class'=> 'form-control',
                              'id'=>'kec',
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
                              'class'=> 'form-control',
                              'id'=>'desa',
                              'disabled' => 'true',
                            ])
                        !!}
                    </div>
                    {!! $message !!}
                </div>
                
                <label for="tipe">Tipe</label>
                <div class="form-group">
                    @php
                    $class = $errors->has('tipe') ? 'form-line error focused' : 'form-line';
                    $message = $errors->has('tipe') ? '<label class="error">' . $errors->first('tipe') . '</label>' : '';
                    @endphp
                    <div class="{{ $class }}">
                        {!!
                          Form::select(
                            'tipe',
                            [
                              'l' => 'Laki - Laki',
                              'p' => 'Perempuan',
                              'c' => 'Campur',
                            ],
                            null,
                            [
                              'class'=> 'form-control select2',
                              'id'=>'tipe',
                              'placeholder' => 'Pilih Tipe',
                            ])
                        !!}
                    </div>
                    {!! $message !!}
                </div>
                
                <label for="bulanan">Biaya Bulanan</label>
                <div class="form-group">
                    @php
                    $class = $errors->has('bulanan') ? 'form-line error focused' : 'form-line';
                    $message = $errors->has('bulanan') ? '<label class="error">' . $errors->first('bulanan') . '</label>' : '';
                    @endphp
                    <div class="{{ $class }}">
                        {!!
                            Form::text(
                                'bulanan', 
                                null, 
                                [
                                    'class'=> 'form-control', 
                                    'id' => 'bulanan', 
                                    'placeholder'=>'Biaya Bulanan',
                                ])
                        !!}
                    </div>
                    {!! $message !!}
                </div>

                <label for="tahunan">Biaya Tahunan</label>
                <div class="form-group">
                    @php
                    $class = $errors->has('tahunan') ? 'form-line error focused' : 'form-line';
                    $message = $errors->has('tahunan') ? '<label class="error">' . $errors->first('tahunan') . '</label>' : '';
                    @endphp
                    <div class="{{ $class }}">
                        {!!
                            Form::text(
                                'tahunan', 
                                null, 
                                [
                                    'class'=> 'form-control', 
                                    'id' => 'tahunan', 
                                    'placeholder'=>'Biaya Tahunan',
                                ])
                        !!}
                    </div>
                    {!! $message !!}
                </div>

                <label for="kamartersedia">Kamar Tersedia</label>
                <div class="form-group">
                    @php
                    $class = $errors->has('kamartersedia') ? 'form-line error focused' : 'form-line';
                    $message = $errors->has('kamartersedia') ? '<label class="error">' . $errors->first('kamartersedia') . '</label>' : '';
                    @endphp
                    <div class="{{ $class }}">
                        {!!
                            Form::number(
                                'kamartersedia', 
                                null, 
                                [
                                    'class'=> 'form-control', 
                                    'id' => 'kamartersedia', 
                                    'placeholder'=>'Kamar Tersedia',
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
$(function() {
  $.ajax({
    type: "POST",
    url: "{{ route('publicAjax.prop') }}",
    data: {
      
    },
    success: function(response) {
      $("#prop").html(response);

      $("#prop").select2();
    },
    error: function(e) {
      swal('ERROR !!!', 'See console!', 'error');

      console.log(e);
    }
  });
});  
</script>

{{-- funcions --}}
<script type="text/javascript">
$("#prop").change(function() {
  $("#kab").prop('disabled', true);
  $("#kec").prop('disabled', true);
  $("#desa").prop('disabled', true);

  $.ajax({
    type: "POST",
    url: "{{ route('publicAjax.kab') }}",
    data: {
      prop : $("#prop").val(),
    },
    success: function(response) {
      $("#kab").html(response);

      $("#kab").prop('disabled', false);

      $("#kab").select2();
    },
    error: function(e) {
      swal('ERROR !!!', 'See console!', 'error');

      console.log(e);
    }
  });
});

$("#kab").change(function() {
  $("#kec").prop('disabled', true);
  $("#desa").prop('disabled', true);

  $.ajax({
    type: "POST",
    url: "{{ route('publicAjax.kec') }}",
    data: {
      kab : $("#kab").val(),
    },
    success: function(response) {
      $("#kec").html(response);

      $("#kec").prop('disabled', false);

      $("#kec").select2();
    },
    error: function(e) {
      swal('ERROR !!!', 'See console!', 'error');

      console.log(e);
    }
  });
});

$("#kec").change(function() {
  $("#desa").prop('disabled', true);

  $.ajax({
    type: "POST",
    url: "{{ route('publicAjax.desa') }}",
    data: {
      kec : $("#kec").val(),
    },
    success: function(response) {
      $("#desa").html(response);

      $("#desa").prop('disabled', false);

      $("#desa").select2();
    },
    error: function(e) {
      swal('ERROR !!!', 'See console!', 'error');

      console.log(e);
    }
  });
});
</script>
@endsection