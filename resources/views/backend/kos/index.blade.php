@extends('template.backend.template')

@section('nav')
@include('backend.kos.nav')
@endsection

@section('content')
<div class="row clearfix">
  <div class="card">
      @adhHeader([
          'title' => 'DATA KOST',
        ])
      @endadhHeader
      <div class="body">
          <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover datatable">
                  <thead>
                      <tr>
                          <th style="text-align: center;">Email Pemilik</th>
                          <th style="text-align: center;">Nama Pemilik</th>
                          <th style="text-align: center;">No HP Pemilik</th>
                          <th style="text-align: center;">Nama</th>
                          <th style="text-align: center;">Alamat</th>
                          {{-- <th style="text-align: center;">Provinsi</th> --}}
                          {{-- <th style="text-align: center;">Kabupaten</th> --}}
                          <th style="text-align: center;">Kecamatan</th>
                          <th style="text-align: center;">Kelurahan</th>
                          <th style="text-align: center;">Tipe</th>
                          <th style="text-align: center;">Bulanan</th>
                          <th style="text-align: center;">Tahunan</th>
                          <th style="text-align: center;">Kamar Tersedia</th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                          <th style="text-align: center;">Proses</th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                      </tr>
                  </thead>
                  <tbody>
                    <script type="text/javascript">
                      var deskripsi = [];
                      var fasilitas = [];
                    </script>
                    @foreach($kosts as $kost)
                    <script type="text/javascript">
                      deskripsi[{{ $kost->id }}] = atob('{!! base64_encode($kost->deskripsi) !!}');
                      @php
                      // dd($kost->fasilitasKos);
                      $fasilitasHTML = '<ul>';
                      foreach($kost->fasilitasKos as $fk) {
                      $fasilitasHTML .= '<li>'.$fk->masterFasilitas->fasilitas.'</li>';
                      }
                      $fasilitasHTML .= '</ul>';
                      @endphp
                      fasilitas[{{ $kost->id }}] = atob('{!! base64_encode($fasilitasHTML) !!}');
                    </script>
                      <tr>
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
                        {{-- <td>{{ ucwords(strtolower($kost->kelurahan->kecamatan->kabupaten->provinsi->nama_prop)) }}</td> --}}
                        {{-- <td>{{ ucwords(strtolower($kost->kelurahan->kecamatan->kabupaten->nama_kab)) }}</td> --}}
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
                        
                            <td>
                            <a href="javascript:void(0)" onclick="modalDeskripsi('{{ $kost->id }}')">
                              <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Deskripsi & Fasilitas">
                                <i class="material-icons">description</i>
                              </button>
                            </a>
                            </td> 

                            <td>
                            <a href="{{ route('kos.mediaLibrary', $kost->id) }}">
                              <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Media Library">
                                <i class="material-icons">photo_library</i>
                              </button>
                            </a>
                            </td>
                            
                            <td>
                            <a target="_blank" href="https://www.google.com/maps/search/{{ $kost->latitude }},{{ $kost->longitude }}">
                              <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Google Maps">
                                <i class="material-icons">place</i>
                              </button>
                            </a>
                            </td>
                            
                            <td>
                            <a href="{{ route('kos.edit', $kost->id) }}">
                              <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Ubah">
                                <i class="material-icons">edit</i>
                              </button>
                            </a>
                            </td>

                            <td>
                            {!! Form::open(['id' => 'formHapus' . $kost->id, 'route' => ['kos.destroy', $kost->id], 'method' => 'delete']) !!}
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
{{-- modal --}}
<div class="modal fade" id="modalDeskripsi" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Deskripsi</h4>
          </div>
          <div class="modal-body" id="modalBody">
              
          </div>
          <div class="modal-header">
              <h4 class="modal-title">Fasilitas</h4>
          </div>
          <div class="modal-body" id="modalFasilitas">
              
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
    $("#modalFasilitas").html(fasilitas[id]);
    $("#modalDeskripsi").modal('show');
  }
</script>
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