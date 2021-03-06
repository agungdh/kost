@extends('template.backend.template')

@section('nav')
@include('backend.kost.nav')
@endsection

@section('content')
<div class="row clearfix">
    <div class="card">
        @adhHeader([
            'title' => 'TAMBAH KOST',
          ])
        @endadhHeader
        <div class="body">
            {!! Form::open(['route' => 'kost.store']) !!}

                @include('backend.kost.form')

                <button type="submit" class="btn btn-success waves-effect">SIMPAN</button>
                <a href="{{ route('kost.index') }}" class="btn btn-primary waves-effect">BATAL</a>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  $(function() {
    $('#optgroup').multiSelect({ selectableOptgroup: false });
  });
</script>
{{-- onsubmit --}}
<script type="text/javascript">
  $("form").submit(function() {
    $("#bulanan").val($("#bulanan").cleanVal());
    $("#tahunan").val($("#tahunan").cleanVal());
    $("#kamartersedia").val($("#kamartersedia").cleanVal());
  });
</script>

@if(!(old('desa') || old('kec') || old('kab') || old('prop')))
{{-- onload --}}
<script type="text/javascript">
$(function() {
  getLocation();

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
</script>

{{-- old desa --}}
@if(old('desa') || old('kec') || old('kab') || old('prop'))
<script type="text/javascript">
  initDaerah();
</script>
@endif

@endsection