@extends('template.backend.template')

@section('nav')
@include('backend.kost.nav')
@endsection

@section('content')
<div class="row clearfix">
  <div class="card">
      <div class="header">
          <h2>
              DATA KOST
          </h2>
      </div>
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
                          <th style="text-align: center;">Proses</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($kosts as $kost)
                      <tr>
                        <td>{{ $kost->nama }}</td>
                        <td>{{ ucwords(strtolower($kost->nama_prop)) }}</td>
                        <td>{{ ucwords(strtolower($kost->nama_kab)) }}</td>
                        <td>{{ ucwords(strtolower($kost->nama_kec)) }}</td>
                        <td>{{ ucwords(strtolower($kost->nama_desa)) }}</td>
                        <td>{{ $kost->alamat }}</td>
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
                            <a href="javascript:void(0)">
                              <button type="button" class="btn bg-red waves-effect" onclick="hapus()" data-toggle="tooltip" data-placement="top" title="Hapus">
                                <i class="material-icons">delete</i>
                              </button>
                            </a>
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
        title: 'Apakah anda yakin?',
        text: "Data akan dihapus!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Hapus!'
    }, function(result) {
        if (result) {
            window.location = "";
        }
    });
};
</script>
@endsection