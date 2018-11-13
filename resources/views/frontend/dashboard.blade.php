@extends('template.frontend.template')

@section('nav')
<li><a href="{{ route('root') }}">Home</a></li>
@endsection

@section('content')
<div class="row clearfix">
  <div class="card">
      <div class="header">
          <h2>
              HOME
          </h2>
      </div>
      <div class="body">
        {!! Form::model($inputs, ['route' => 'root', 'method' => 'get']) !!}

            {!!
                Form::adhSelect2(
                    'Tipe',
                    'tipe', 
                    [
                      'l' => 'Laki - Laki',
                      'p' => 'Perempuan',
                      'lp' => 'Campur',
                    ], 
                    null, 
                    []
                )
            !!}
            
            {!!
                Form::adhSelect2(
                    'Bulanan / Tahunan',
                    'waktupembayaran', 
                    [
                      'b' => 'Bulanan',
                      't' => 'Tahunan',
                    ], 
                    null, 
                    []
                )
            !!}

            {!!
                Form::adhSelect2(
                    'Ketersediaan Kamar',
                    'kamartersedia', 
                    [
                      'y' => 'Tersedia',
                      'n' => 'Tidak Tersedia',
                    ], 
                    null, 
                    []
                )
            !!}

            {!!
                Form::adhSelect2(
                    'Alamat Terverifikasi ?',
                    'alamatverifikasi', 
                    [
                      'y' => 'Ya',
                      'n' => 'Tidak',
                    ], 
                    null, 
                    []
                )
            !!}

            {!!
                Form::adhText(
                    'Biaya Minimum (Bulanan)',
                    'bulanmin',  
                    null, 
                    [
                      'class' => 'form-control uang',
                    ]
                )
            !!}

            {!!
                Form::adhText(
                    'Biaya Maximum (Bulanan)',
                    'bulanmax',  
                    null, 
                    [
                      'class' => 'form-control uang',
                    ]
                )
            !!}

            {!!
                Form::adhText(
                    'Biaya Minimum (Tahunan)',
                    'tahunmin',  
                    null, 
                    [
                      'class' => 'form-control uang',
                    ]
                )
            !!}

            {!!
                Form::adhText(
                    'Biaya Maximum (Tahunan)',
                    'tahunmax',  
                    null, 
                    [
                      'class' => 'form-control uang',
                    ]
                )
            !!}

            <button type="submit" class="btn btn-success waves-effect">SIMPAN</button>
            <a href="{{ route('kos.index') }}" class="btn btn-primary waves-effect">BATAL</a>

        {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  $("form").submit(function() {
    if ($("#bulanmin").val() != '' && $("#bulanmax").val() != '') {
      if ($("#bulanmin").cleanVal() > $("#bulanmax").cleanVal()) {
        alert('ngawor');
        
        return false;
      }
    }

    if ($("#tahunmin").val() != '' && $("#tahunmax").val() != '') {
      if ($("#tahunmin").cleanVal() > $("#tahunmax").cleanVal()) {
        alert('ngawor');

        return false;
      }
    }

    $("#bulanmin").val($("#bulanmin").cleanVal());
    $("#bulanmax").val($("#bulanmax").cleanVal());
    $("#tahunmin").val($("#tahunmin").cleanVal());
    $("#tahunmax").val($("#tahunmax").cleanVal());
  });
</script>
@endsection