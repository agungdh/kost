@extends('template.backend.template')

@section('nav')
@include('backend.kost.nav')
@endsection

@section('content')
<div class="row clearfix">
  <div class="card">
      @adhheader([
          'title' => 'DATA KOST',
        ])
      @endadhheader
      <div class="body">
          <div class="button-demo">
            <a href="{{ route('kost.create') }}">
              <button type="button" class="btn bg-blue waves-effect">
                <i class="material-icons">add</i>Tambah Kost
              </button>
            </a>
          </div>
          <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover datatable">
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
                          <th style="text-align: center;">Deskripsi</th>
                          <th style="text-align: center;">Proses</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($kosts as $kost)
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
                        <td>{{ ucwords(strtolower($kost->nama_prop)) }}</td>
                        <td>{{ ucwords(strtolower($kost->nama_kab)) }}</td>
                        <td>{{ ucwords(strtolower($kost->nama_kec)) }}</td>
                        <td>{{ ucwords(strtolower($kost->nama_desa)) }}</td>
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
                        <td>{{ $kost->deskripsi }}</td>
                          <td style="text-align: center;">
                            
                            <a href="{{ route('kost.mediaLibrary', $kost->id) }}">
                              <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Media Library">
                                <i class="material-icons">photo_library</i>
                              </button>
                            </a>
                            
                            <a target="_blank" href="https://www.google.com/maps/search/{{ $kost->latitude }},{{ $kost->longitude }}">
                              <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Google Maps">
                                <i class="material-icons">place</i>
                              </button>
                            </a>
                            
                            <a href="{{ route('kost.edit', $kost->id) }}">
                              <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Ubah">
                                <i class="material-icons">edit</i>
                              </button>
                            </a>

                            {!! Form::open(['id' => 'formHapus' . $kost->id, 'route' => ['kost.destroy', $kost->id], 'method' => 'delete']) !!}
                            <button type="button" class="btn bg-red waves-effect" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('{{ $kost->id }}')">
                                <i class="material-icons">delete</i>
                              </button>
                            {!! Form::close() !!}

                          </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  function hapus(id) {
    swal({
      title: "Yakin Hapus?",
      text: "Setelah dihapus data tidak dapat dikembalikan!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal',
      closeOnConfirm: false
    }, function () {
      $("#formHapus" + id).submit();
    });
  }
</script>
@endsection