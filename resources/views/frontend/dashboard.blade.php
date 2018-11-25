@extends('template.frontend.template')

@section('nav')
<li><a href="{{ route('root') }}">Home</a></li>
@endsection

@section('content')
<div class="row clearfix">

  {!! Form::model($inputs, ['route' => 'root', 'method' => 'get']) !!}

    <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="header">
          <h2>
              HOME
          </h2>
      </div>
    </div>

    <div class="card col-lg-4 col-md-4 col-sm-12 col-xs-12">
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
                    Form::adhText(
                        'Halaman Saat Ini',
                        'page', 
                        true,  
                        $inputs['page'], 
                        [
                          'class' => 'form-control uang',
                        ]
                    )
                !!}

                <div class="form-group">
                  <label>Jumlah Data: {{ $kosts->total() }}</label>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-success waves-effect">CARI</button>
                  <a href="javascript:void(0)" onclick="resetAll()" class="btn btn-primary waves-effect">RESET</a>
                </div>

          </div>
    </div>

    <div class="card col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="body">
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
            Form::adhText(
                'Ketersediaan Kamar Minimum',
                'kamartersediamin', 
                true,  
                null, 
                [
                  'class' => 'form-control uang',
                ]
            )
        !!}

        {!!
            Form::adhText(
                'Ketersediaan Kamar Maximum',
                'kamartersediamax', 
                true,  
                null, 
                [
                  'class' => 'form-control uang',
                ]
            )
        !!}

        {!!
            Form::adhText(
                'Jumlah Data Per Halaman',
                'jumlahperhalaman', 
                true,  
                null, 
                [
                  'class' => 'form-control uang',
                ]
            )
        !!}

        <div class="form-group">
          <label>Jumlah Halaman: {{ $kosts->lastPage() }}</label>
        </div>
        <div class="form-group"><p style="visibility: hidden;">dummy</p></div>
      </div>
    </div>

    <div class="card col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="body">
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

        {!!
            Form::adhSelect2(
                'Urut',
                'urut', 
                true,
                [
                  'namaa' => 'Nama (A-Z)',
                  'namaz' => 'Nama (Z-A)',
                  'alamata' => 'Alamat (A-Z)',
                  'alamatz' => 'Alamat (Z-A)',
                  'provinsia' => 'Provinsi (A-Z)',
                  'provinsiz' => 'Provinsi (Z-A)',
                  'kabupatena' => 'Kabupaten (A-Z)',
                  'kabupatenz' => 'Kabupaten (Z-A)',
                  'kecamatana' => 'Kecamatan (A-Z)',
                  'kecamatanz' => 'Kecamatan (Z-A)',
                  'kelurahana' => 'Kelurahan (A-Z)',
                  'kelurahanz' => 'Kelurahan (Z-A)',
                  'tipea' => 'Tipe (A-Z)',
                  'tipez' => 'Tipe (Z-A)',
                  'bulanana' => 'Bulanan (A-Z)',
                  'bulananz' => 'Bulanan (Z-A)',
                  'tahunana' => 'Tahunan (A-Z)',
                  'tahunanz' => 'Tahunan (Z-A)',
                  'kamartersediaa' => 'Kamar Tersedia (A-Z)',
                  'kamartersediaz' => 'Kamar Tersedia (Z-A)',
                  'emailpemilika' => 'Email Pemilik (A-Z)',
                  'emailpemilikz' => 'Email Pemilik (Z-A)',
                  'namapemilika' => 'Nama Pemilik (A-Z)',
                  'namapemilikz' => 'Nama Pemilik (Z-A)',
                  'nohppemilika' => 'No HP Pemilik (A-Z)',
                  'nohppemilikz' => 'No HP Pemilik (Z-A)',
                ]
            )
        !!}

      </div>
    </div>

      {!! Form::close() !!}

    <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="body">
          <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover">
                  <thead>
                      <tr>
                          <th style="text-align: center;">Nama</th>
                          <th style="text-align: center;">Alamat</th>
                          <th style="text-align: center;">Provinsi</th>
                          <th style="text-align: center;">Kabupaten</th>
                          <th style="text-align: center;">Kecamatan</th>
                          <th style="text-align: center;">Kelurahan</th>
                          <th style="text-align: center;">Tipe</th>
                          <th style="text-align: center;">Bulanan</th>
                          <th style="text-align: center;">Tahunan</th>
                          <th style="text-align: center;">Kamar Tersedia</th>
                          <th style="text-align: center;">Email Pemilik</th>
                          <th style="text-align: center;">Nama Pemilik</th>
                          <th style="text-align: center;">No HP Pemilik</th>

                          <th colspan="4" style="text-align: center;">Proses</th>
                      </tr>
                  </thead>
                  <tbody>
                    <script type="text/javascript">
                      var deskripsi = [];
                    </script>
                    @foreach($kosts as $kost)
                      <script type="text/javascript">
                        deskripsi[{{ $kost->id }}] = "{{ $kost->deskripsi }}";
                      </script>
                      <tr>
                        <td>{{ $kost->nama }}</td>
                        @php
                        if($kost->verified_alamat == 'y') {
                          $title = 'Verified';
                          $icon = '&#10003;';
                        } else {
                          $title = 'Unverified';
                          $icon = '?';
                        }
                        @endphp
                        <td>{{ $kost->alamat }}<label data-toggle="tooltip" data-placement="top" title="{{ $title }}">({!! $icon !!})</label></td>
                        <td>{{ ucwords(strtolower($kost->kelurahan->kecamatan->kabupaten->provinsi->nama_prop)) }}</td>
                        <td>{{ ucwords(strtolower($kost->kelurahan->kecamatan->kabupaten->nama_kab)) }}</td>
                        <td>{{ ucwords(strtolower($kost->kelurahan->kecamatan->nama_kec)) }}</td>
                        <td>{{ ucwords(strtolower($kost->kelurahan->nama_desa)) }}</td>
                        @php
                        switch ($kost->tipe) {
                          case 'l':
                            $tipe = 'Laki - Laki';
                            break;
                          
                          case 'p':
                            $tipe = 'Perempuan';
                            break;
                          
                          case 'lp':
                            $tipe = 'Campur';
                            break;
                          
                          default:
                            $tipe = 'ERROR !!!';
                            break;
                        }
                        @endphp
                        <td>{{ $tipe }}</td>
                        <td>{{ $kost->bulanan != 0 ? $pustaka->rupiah($kost->bulanan) : '-' }}</td>
                        <td>{{ $kost->tahunan != 0 ? $pustaka->rupiah($kost->tahunan) : '-' }}</td>
                        <td>{{ $kost->kamartersedia }}</td>
                        <td>{{ $kost->user->email }}</td>
                        <td>{{ $kost->user->nama }}</td>
                        @php
                        if($kost->user->verified_nohp == 'y') {
                          $title = 'Verified';
                          $icon = '&#10003;';
                        } else {
                          $title = 'Unverified';
                          $icon = '?';
                        }
                        @endphp
                        <td>{{ $kost->user->nohp }}<label data-toggle="tooltip" data-placement="top" title="{{ $title }}">({!! $icon !!})</label></td>

                            <td>
                            <a href="javascript:void(0)" onclick="modalDeskripsi('{{ $kost->id }}')">
                              <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Deskripsi">
                                <i class="material-icons">description</i>
                              </button>
                            </a>
                            </td>

                            <td>
                            {{-- media library --}}
                            <div id="mediaLibrary{{ $kost->id }}">
                              
                              @php
                              $i = 1;
                              @endphp
                              @foreach($kost->fotos as $foto)
                                @php
                                if (file_exists(storage_path('app/public/foto/kos/' . $foto->id))) {
                                    $url = asset('storage/foto/kos/' . $foto->id);
                                } else {
                                    $url = asset('assets/img/sorry-no-image-available.png');
                                }
                                @endphp
                                <a href="{{ $url }}" data-sub-html="{{ $foto->deskripsi }}">
                                  <img style="display: none;" src="{{ $url }}">
                                  @if($i == 1)
                                  <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Foto">
                                  <i class="material-icons">photo_library</i>
                                  </button>
                                  @endif
                                </a>
                                @php
                                $i++;
                                @endphp
                              @endforeach
                            </div>
                            </td>
                            
                            <td>
                            <a target="_blank" href="https://www.google.com/maps/search/{{ $kost->latitude }},{{ $kost->longitude }}">
                              <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Google Maps">
                                <i class="material-icons">place</i>
                              </button>
                            </a>
                            </td>

                            <td></td>
                          
                      </tr>

                    @endforeach
                  </tbody>
              </table>
          </div>

          <ul class="pager">
              @if($kosts->currentPage() == 1)
                <li><a href="javascript:void(0);" class="waves-effect disabled">Previous</a></li>
              @else
                <li><a href="{{ $fullUrl }}&page={{ $kosts->currentPage() - 1 }}" class="waves-effect">Previous</a></li>
              @endif
              @if($kosts->hasMorePages() == 1)
              <li><a href="{{ $fullUrl }}&page={{ $kosts->currentPage() + 1 }}" class="waves-effect">Next</a></li>
              @else
              <li><a href="javascript:void(0);" class="waves-effect disabled">Next</a></li>
              @endif
          </ul>

      </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="modalDeskripsi" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Deskripsi</h4>
              </div>
              <div class="modal-body" id="modalBody">
                  
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
              </div>
          </div>
      </div>
  </div>

@endsection

@section('js')
<script type="text/javascript">
  function modalDeskripsi(id) {
    $("#modalBody").html(deskripsi[id]);
    $("#modalDeskripsi").modal('show');
  }
</script>

<script type="text/javascript">
  function resetAll() {
    $('input').val('');
    $('option').attr('selected', false);
    $('.select2').select2();
  }
</script>
<script type="text/javascript">
  $("#waktupembayaran").on('change', function() {
    gantiWaktuPembayaran();
  });

  function gantiWaktuPembayaran() {
    switch($("#waktupembayaran").val()) {
        case 'b':
            $("#tahunmax").prop('disabled', true);
            $("#tahunmin").prop('disabled', true);
            $("#tahunmax").val('');
            $("#tahunmin").val('');
            
            $("#bulanmax").prop('disabled', false);
            $("#bulanmin").prop('disabled', false);
            break;
        case 't':
            $("#tahunmax").prop('disabled', false);
            $("#tahunmin").prop('disabled', false);
            
            $("#bulanmax").prop('disabled', true);
            $("#bulanmin").prop('disabled', true);
            $("#bulanmax").val('');
            $("#bulanmin").val('');
            break;
        default:
            $("#tahunmax").prop('disabled', false);
            $("#tahunmin").prop('disabled', false);
            
            $("#bulanmax").prop('disabled', false);
            $("#bulanmin").prop('disabled', false);
            break;
    }
  }
</script>

<script type="text/javascript">
  $("form").submit(function() {
    if ($("#bulanmin").val() != '' && $("#bulanmax").val() != '') {
      if (parseInt($("#bulanmin").cleanVal()) > parseInt($("#bulanmax").cleanVal())) {
        swal('ERROR !!!', 'Biaya Minimum (Bulanan) tidak boleh lebih dari Biaya Maximum (Bulanan)', 'error');
        
        return false;
      }
    }

    if ($("#tahunmin").val() != '' && $("#tahunmax").val() != '') {
      if (parseInt($("#tahunmin").cleanVal()) > parseInt($("#tahunmax").cleanVal())) {
        swal('ERROR !!!', 'Biaya Minimum (Tahunan) tidak boleh lebih dari Biaya Maximum (Tahunan)', 'error');

        return false;
      }
    }

    if ($("#kamartersediamin").val() != '' && $("#kamartersediamax").val() != '') {
      if (parseInt($("#kamartersediamin").cleanVal()) > parseInt($("#kamartersediamax").cleanVal())) {
        swal('ERROR !!!', 'Ketersediaan Kamar Minimum tidak boleh lebih dari Ketersediaan Kamar Maximum', 'error');

        return false;
      }
    }

    $("#kamartersediamin").val($("#kamartersediamin").cleanVal());
    $("#kamartersediamax").val($("#kamartersediamax").cleanVal());
    $("#bulanmin").val($("#bulanmin").cleanVal());
    $("#bulanmax").val($("#bulanmax").cleanVal());
    $("#tahunmin").val($("#tahunmin").cleanVal());
    $("#tahunmax").val($("#tahunmax").cleanVal());
    $("#page").val($("#page").cleanVal());
    $("#jumlahperhalaman").val($("#jumlahperhalaman").cleanVal());
  });
</script>

@if(!(old('desa') || old('kec') || old('kab') || old('prop')))
{{-- onload --}}
<script type="text/javascript">
$(function() {
  initDaerahEdit();

  gantiWaktuPembayaran();

  @foreach($kosts as $kost)
  $("#mediaLibrary{{ $kost->id }}").lightGallery({thumbnail: true, selector: 'a'});
  @endforeach
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