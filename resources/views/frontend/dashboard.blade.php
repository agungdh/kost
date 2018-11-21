@extends('template.frontend.template')

@section('nav')
<li><a href="{{ route('root') }}">Home</a></li>
@endsection

@section('content')
<div class="row clearfix">

  {!! Form::model($inputs, ['route' => 'root', 'method' => 'get']) !!}

    <div class="card">
        <div class="header">
            <h2>
                HOME
            </h2>
        </div>

          <div class="body">

                {!!
                    Form::adhSelect2(
                        'Provinsi',
                        'prop'
                    )
                !!}

                {!!
                    Form::adhSelect2(
                        'Kabupaten',
                        'kab'
                    )
                !!}

                {!!
                    Form::adhSelect2(
                        'Kecamatan',
                        'kec'
                    )
                !!}

                {!!
                    Form::adhSelect2(
                        'Kelurahan',
                        'desa'
                    )
                !!}            

                {!!
                    Form::adhSelect2(
                        'Tipe',
                        'tipe', 
                        true,
                        [
                          'l' => 'Laki - Laki',
                          'p' => 'Perempuan',
                          'lp' => 'Campur',
                        ]
                    )
                !!}
                
                {!!
                    Form::adhSelect2(
                        'Bulanan / Tahunan',
                        'waktupembayaran', 
                        true,
                        [
                          'b' => 'Bulanan',
                          't' => 'Tahunan',
                        ]
                    )
                !!}

                {!!
                    Form::adhSelect2(
                        'Ketersediaan Kamar',
                        'kamartersedia', 
                        true,
                        [
                          'y' => 'Tersedia',
                          'n' => 'Tidak Tersedia',
                        ]
                    )
                !!}

                {!!
                    Form::adhSelect2(
                        'Alamat Terverifikasi ?',
                        'alamatverifikasi', 
                        true,
                        [
                          'y' => 'Ya',
                          'n' => 'Tidak',
                        ]
                    )
                !!}

                {!!
                    Form::adhText(
                        'Biaya Minimum (Bulanan)',
                        'bulanmin',
                        true,  
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
                        true,  
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
                        true,  
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
                        true,  
                        null, 
                        [
                          'class' => 'form-control uang',
                        ]
                    )
                !!}

                <button type="submit" class="btn btn-success waves-effect">SIMPAN</button>
                <a href="{{ route('kos.index') }}" class="btn btn-primary waves-effect">BATAL</a>
          </div>
    </div>

  {!! Form::close() !!}

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

@if(!(old('desa') || old('kec') || old('kab') || old('prop')))
{{-- onload --}}
<script type="text/javascript">
$(function() {
  getLocation();

  initDaerahEdit();
});  
</script>
@endif

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

function initDaerah() {
  $("#prop").prop('disabled', true);
  $("#kab").prop('disabled', true);
  $("#kec").prop('disabled', true);
  $("#desa").prop('disabled', true);

  $.ajax({
    type: "POST",
    url: "{{ route('publicAjax.prop') }}",
    data: {
      
    },
    success: function(response) {
      $("#prop").html(response);

      $("#prop").prop('disabled', false);

      $("#prop").val('{{ old('prop') }}');

      $("#prop").select2();

      $.ajax({
        type: "POST",
        url: "{{ route('publicAjax.kab') }}",
        data: {
          prop : $("#prop").val(),
        },
        success: function(response) {
          $("#kab").html(response);

          $("#kab").prop('disabled', false);

          $("#kab").val('{{ old('kab') }}');

          $("#kab").select2();

          $.ajax({
            type: "POST",
            url: "{{ route('publicAjax.kec') }}",
            data: {
              kab : $("#kab").val(),
            },
            success: function(response) {
              $("#kec").html(response);

              $("#kec").prop('disabled', false);

              $("#kec").val('{{ old('kec') }}');

              $("#kec").select2();

              $.ajax({
                type: "POST",
                url: "{{ route('publicAjax.desa') }}",
                data: {
                  kec : $("#kec").val(),
                },
                success: function(response) {
                  $("#desa").html(response);

                  $("#desa").prop('disabled', false);

                  $("#desa").val('{{ old('desa') }}');

                  $("#desa").select2();
                },
                error: function(e) {
                  swal('ERROR !!!', 'See console!', 'error');

                  console.log(e);
                }
              });
            },
            error: function(e) {
              swal('ERROR !!!', 'See console!', 'error');

              console.log(e);
            }
          });
        },
        error: function(e) {
          swal('ERROR !!!', 'See console!', 'error');

          console.log(e);
        }
      });
    },
    error: function(e) {
      swal('ERROR !!!', 'See console!', 'error');

      console.log(e);
    }
  });
}

function initDaerahEdit() {
  $("#prop").prop('disabled', true);
  $("#kab").prop('disabled', true);
  $("#kec").prop('disabled', true);
  $("#desa").prop('disabled', true);

  $.ajax({
    type: "POST",
    url: "{{ route('publicAjax.prop') }}",
    data: {
      
    },
    success: function(response) {
      $("#prop").html(response);

      $("#prop").prop('disabled', false);

      $("#prop").val('{{ $inputs['prop'] }}');

      $("#prop").select2();

      $.ajax({
        type: "POST",
        url: "{{ route('publicAjax.kab') }}",
        data: {
          prop : $("#prop").val(),
        },
        success: function(response) {
          $("#kab").html(response);

          $("#kab").prop('disabled', false);

          $("#kab").val('{{ $inputs['kab'] }}');

          $("#kab").select2();

          $.ajax({
            type: "POST",
            url: "{{ route('publicAjax.kec') }}",
            data: {
              kab : $("#kab").val(),
            },
            success: function(response) {
              $("#kec").html(response);

              $("#kec").prop('disabled', false);

              $("#kec").val('{{ $inputs['kec'] }}');

              $("#kec").select2();

              $.ajax({
                type: "POST",
                url: "{{ route('publicAjax.desa') }}",
                data: {
                  kec : $("#kec").val(),
                },
                success: function(response) {
                  $("#desa").html(response);

                  $("#desa").prop('disabled', false);

                  $("#desa").val('{{ $inputs['desa'] }}');

                  $("#desa").select2();
                },
                error: function(e) {
                  swal('ERROR !!!', 'See console!', 'error');

                  console.log(e);
                }
              });
            },
            error: function(e) {
              swal('ERROR !!!', 'See console!', 'error');

              console.log(e);
            }
          });
        },
        error: function(e) {
          swal('ERROR !!!', 'See console!', 'error');

          console.log(e);
        }
      });
    },
    error: function(e) {
      swal('ERROR !!!', 'See console!', 'error');

      console.log(e);
    }
  });
}
</script>

{{-- old desa --}}
@if(old('desa') || old('kec') || old('kab') || old('prop'))
<script type="text/javascript">
  initDaerah();
</script>
@endif

@endsection