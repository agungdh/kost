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
                          <th style="text-align: center;">ID Transaksi</th>
                          <th style="text-align: center;">Nama Pemilik</th>
                          <th style="text-align: center;">No HP Pemilik</th>
                          <th style="text-align: center;">Nama</th>
                          <th style="text-align: center;">Alamat</th>
                          {{-- <th style="text-align: center;">Provinsi</th> --}}
                          {{-- <th style="text-align: center;">Kabupaten</th> --}}
                          <th style="text-align: center;">Kecamatan</th>
                          <th style="text-align: center;">Kelurahan</th>
                          <th style="text-align: center;">Tipe</th>
                          {{-- <th style="text-align: center;">Bulanan</th> --}}
                          <th style="text-align: center;">Biaya Per Tahun</th>
                          <th style="text-align: center;">Jumlah Kamar</th>
                          <th style="text-align: center;">Lama Kost (Tahun)</th>
                          <th style="text-align: center;">Jumlah</th>
                          <th style="text-align: center;">Status</th>
                          <th style="text-align: center;">Bukti Transfer</th>
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
                    </script>
                    @php
                    $iteration = 0;
                    @endphp
                    @foreach($transaksis as $transaksi)
                    @php
                    $kost = $transaksi->kos;
                    @endphp
                    <script type="text/javascript">
                      deskripsi[{{ $kost->id }}] = atob('{!! base64_encode($kost->deskripsi) !!}');
                    </script>
                      <tr>
                        <td>#{{$transaksi->id}}</td>
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
                        {{-- <td>{{ $kost->bulanan != 0 ? $pustaka->rupiah($kost->bulanan) : '-' }}</td> --}}
                        <td>{{ $kost->tahunan != 0 ? $pustaka->rupiah($kost->tahunan) : '-' }}</td>
                        <td>{{ $transaksi->jumlah_kamar }}</td>
                        <td>{{ $transaksi->lama_kost }}</td>
                        <td>{{ $pustaka->rupiah($transaksi->harga) }}</td>
                        <td>
                          @php
                          $disabled = [
                            'btnCancel' => 'disabled',
                            'btnUpload' => 'disabled',
                            'img' => true,
                          ];
                          switch ($transaksi->status) {
                            case 'a':
                              $berlakuSampai = date("d-m-Y", strtotime("+{$transaksi->lama_kost} years", strtotime($transaksi->waktu_validasi)));
                              $s = "Diterima. Berlaku Sampai: {$berlakuSampai}";
                              break;
                            case 'd':
                              $s = 'Ditolak';
                              break;
                            case 'c':
                              $s = 'Dibatalkan';
                              break;
                            default:
                              if ($transaksi->waktu_upload_bukti) {
                                $s = 'Menunggu Konfirmasi';
                              } else {
                                $s = 'Silakan Upload Bukti Transfer';
                              }
                              $disabled['btnCancel'] = '';
                              $disabled['btnUpload'] = '';
                              unset($disabled['img']);
                              break;
                          }
                          @endphp
                          {{$s}}
                          @if($transaksi->status == 'a')
                          <a href="{{ route('invoice', $transaksi->id) }}">
                            <button type="button" class="btn bg-green waves-effect" data-toggle="tooltip" data-placement="top" title="Download Invoice">
                              <i class="material-icons">file_download</i>
                            </button>
                          </a>
                          @endif
                        </td>
                        
                        @php
                        if (file_exists(storage_path('app/public/foto/bukti/' . $transaksi->id))) {
                            $url_gambar_bukti = asset('storage/foto/bukti/' . $transaksi->id);
                        }
                        @endphp

                        {!! Form::open(['id' => 'formUpload' . $transaksi->id, 'route' => ['pesananUser.upBukti', $transaksi->id], 'files' => true]) !!}
                        <td>
                        @if(isset($url_gambar_bukti))
                        @php
                        $disBtn = 'disabled';
                        @endphp
                        {{-- <img src="{{$url_gambar_bukti}}"> --}}
                        
                        <div id="mediaLibraryTx{{ $iteration }}">
                          <a href="{{ $url_gambar_bukti }}" data-sub-html="{{ $pustaka->tanggalWaktuIndo($transaksi->waktu_upload_bukti) }}">
                            <img width="160px" height="90px" src="{{ $url_gambar_bukti }}">
                          </a>
                        </div>
                        <script type="text/javascript">
                            $("#mediaLibraryTx{{$iteration}}").lightGallery({thumbnail: true, selector: 'a'});  
                            </script>
                        @else
                        @php
                        $disBtn = '';
                        @endphp
                        <div class="form-group">
                          @php
                          $class = $errors->has('berkas__' . $transaksi->id) ? 'form-line error focused' : 'form-line';
                          $message = $errors->has('berkas__' . $transaksi->id) ? '<label class="error">' . $errors->first('berkas__' . $transaksi->id) . '</label>' : '';
                          @endphp
                          @if(isset($disabled['img']))
                            -
                          @else
                          <div class="{{$class}}">
                            <input type="file" name="berkas__{{$transaksi->id}}">
                          </div>
                          @endif
                          {!! $message !!}
                        </div>
                        @endif
                        </td>
                        <td>
                        <button type="button" {{$disBtn}} {{$disabled['btnUpload']}} class="btn bg-green waves-effect" data-toggle="tooltip" data-placement="top" title="Upload Bukti Transfer" onclick="upload('{{ $transaksi->id }}')">
                            <i class="material-icons">file_upload</i>
                        </button>
                        </td>
                        @php
                        unset($url_gambar_bukti);
                        unset($disBtn);
                        @endphp
                        {!! Form::close() !!}

                            <td>
                            <a href="javascript:void(0)" onclick="modalDeskripsi('{{ $kost->id }}')">
                              <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Deskripsi">
                                <i class="material-icons">description</i>
                              </button>
                            </a>
                            </td> 

                            <td>
                            {{-- media library --}}
                            <div id="mediaLibrary{{ $iteration }}">
                              
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
                            <script type="text/javascript">
                            $("#mediaLibrary{{$iteration}}").lightGallery({thumbnail: true, selector: 'a'});  
                            </script>
                            </td>
                                                        
                            {{-- <td>
                            {!! Form::open(['id' => 'formHapus' . $kost->id, 'route' => ['kos.destroy', $kost->id], 'method' => 'delete']) !!}
                            <button type="button" class="btn bg-green waves-effect" data-toggle="tooltip" data-placement="top" title="Konfirmasi Pemesanan" onclick="hapus('{{ $kost->id }}')">
                                <i class="material-icons">check</i>
                              </button>
                            {!! Form::close() !!}
                            </td> --}}

                            <td>
                            <a target="_blank" href="https://www.google.com/maps/search/{{ $kost->latitude }},{{ $kost->longitude }}">
                              <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Google Maps">
                                <i class="material-icons">place</i>
                              </button>
                            </a>
                            </td>


                            <td>
                            {!! Form::open(['id' => 'formCancel' . $transaksi->id, 'route' => ['pesananUser.cancel', $transaksi->id], 'method' => 'delete']) !!}
                            <button type="button" {{$disabled['btnCancel']}} class="btn bg-red waves-effect" data-toggle="tooltip" data-placement="top" title="Batalkan Pesanan" onclick="cancel('{{ $transaksi->id }}')">
                                <i class="material-icons">delete</i>
                              </button>
                            {!! Form::close() !!}
                            </td>

                      </tr>
                      @php
                      unset($disabled);
                      $iteration++;
                      @endphp
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
          <div class="modal-footer">
              <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
          </div>
      </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  function cancel(id) {
    swal({
      title: "Yakin Batalkan?",
      text: "Setelah dibatalkan data tidak dapat dikembalikan!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: 'Ya, batalkan!',
      cancelButtonText: 'Kembali',
      closeOnConfirm: false
    }, function () {
      $("#formCancel" + id).submit();
    });
  }
</script>
<script type="text/javascript">
  function modalDeskripsi(id) {
    $("#modalBody").html(deskripsi[id]);
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
<script type="text/javascript">
  function upload(id) {
    swal({
      title: "Yakin Upload?",
      text: "Setelah diupload data tidak dapat dikembalikan!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-success",
      confirmButtonText: 'Ya, upload!',
      cancelButtonText: 'Batal',
      closeOnConfirm: false
    }, function () {
      $("#formUpload" + id).submit();
    });
  }
</script>
@endsection