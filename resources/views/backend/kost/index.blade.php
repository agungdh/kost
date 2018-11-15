@extends('template.backend.template')

@section('nav')
@include('backend.kost.nav')
@endsection

@section('content')
<div class="row clearfix">
  <div class="card">
      @adhHeader([
          'title' => 'DATA KOST',
        ])
      @endadhHeader
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
                    @foreach($kosses as $kos)
                      <tr>
                        <td>{{ $kos->nama }}</td>
                        @php
                        if($kos->verified_alamat == 'y') {
                          $title = 'Verified';
                          $icon = '&#10003;';
                        } else {
                          $title = 'Unverified';
                          $icon = '?';
                        }
                        @endphp
                        <td>{{ $kos->alamat }}<label data-toggle="tooltip" data-placement="top" title="{{ $title }}">({!! $icon !!})</label></td>
                        <td>{{ ucwords(strtolower($kos->kelurahan->kecamatan->kabupaten->provinsi->nama_prop)) }}</td>
                        <td>{{ ucwords(strtolower($kos->kelurahan->kecamatan->kabupaten->nama_kab)) }}</td>
                        <td>{{ ucwords(strtolower($kos->kelurahan->kecamatan->nama_kec)) }}</td>
                        <td>{{ ucwords(strtolower($kos->kelurahan->nama_desa)) }}</td>
                        @php
                        switch ($kos->tipe) {
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
                        <td>{{ $kos->bulanan != 0 ? $pustaka->rupiah($kos->bulanan) : '-' }}</td>
                        <td>{{ $kos->tahunan != 0 ? $pustaka->rupiah($kos->tahunan) : '-' }}</td>
                        <td>{{ $kos->kamartersedia }}</td>
                        <td>{{ $kos->deskripsi }}</td>
                          <td style="text-align: center;">
                            
                            <a href="{{ route('kost.mediaLibrary', $kos->id) }}">
                              <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Media Library">
                                <i class="material-icons">photo_library</i>
                              </button>
                            </a>
                            
                            <a target="_blank" href="https://www.google.com/maps/search/{{ $kos->latitude }},{{ $kos->longitude }}">
                              <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Google Maps">
                                <i class="material-icons">place</i>
                              </button>
                            </a>
                            
                            <a href="{{ route('kost.edit', $kos->id) }}">
                              <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Ubah">
                                <i class="material-icons">edit</i>
                              </button>
                            </a>

                            {!! Form::open(['id' => 'formHapus' . $kos->id, 'route' => ['kost.destroy', $kos->id], 'method' => 'delete']) !!}
                            <button type="button" class="btn bg-red waves-effect" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('{{ $kos->id }}')">
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