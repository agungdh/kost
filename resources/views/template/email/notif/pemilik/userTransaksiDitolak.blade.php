<h3>Pesanan untuk kost anda telah ditolak</h3>

<h4>ID Pesanan adalah <b><u>{{ $transaksi->id }}</u></b></h4>

<table class="table">
  <tr>
    <td>NAMA</td>
    <td>: {{ $kos->nama }}</td>
    <td>TIPE</td>
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
    <td>: {{ $tipe }}</td>
  </tr>
  <tr>
    {{-- <td>BULANAN: </td> --}}
    {{-- <td>{{ $kos->bulanan != 0 ? $pustaka->rupiah($kos->bulanan) : '-' }}</td> --}}
    @php
    if($kos->verified_alamat == 'y') {
      $title = 'Verified';
      $icon = '&#10003;';
    } else {
      $title = 'Unverified';
      $icon = '?';
    }
    @endphp
    <td>ALAMAT</td>
    <td>: {{ $kos->alamat }}<label data-toggle="tooltip" data-placement="top" title="{{ $title }}">({!! $icon !!})</label></td>
    {{-- <td></td> --}}
    <td></td>
  </tr>
  <tr>
    <td>BIAYA PER TAHUN</td>
    <td>: {{ $kos->tahunan != 0 ? $pustaka->rupiah($kos->tahunan) : '-' }}</td>
    <td>PROVINSI</td>
    <td>: {{ ucwords(strtolower($kos->kelurahan->kecamatan->kabupaten->provinsi->nama_prop)) }}</td>
  </tr>
  <tr>
    <td>KAMAR TERSEDIA</td>
    <td>: {{ $kos->kamartersedia }}</td>
    <td>KABUPATEN</td>
    <td>: {{ ucwords(strtolower($kos->kelurahan->kecamatan->kabupaten->nama_kab)) }}</td>
  </tr>
  <tr>
    <td>NAMA PEMILIK</td>
    <td>: {{ $kos->user->nama }}</td>
    <td>KECAMATAN</td>
    <td>: {{ ucwords(strtolower($kos->kelurahan->kecamatan->nama_kec)) }}</td>
  </tr>
  <tr>
    <td>NO HP PEMILIK</td>
    @php
    if($kos->user->verified_nohp == 'y') {
      $title = 'Verified';
      $icon = '&#10003;';
    } else {
      $title = 'Unverified';
      $icon = '?';
    }
    @endphp
    <td>: {{ $kos->user->nohp }}<label data-toggle="tooltip" data-placement="top" title="{{ $title }}">({!! $icon !!})</label></td>
    <td>KELURAHAN</td>
    <td>: {{ ucwords(strtolower($kos->kelurahan->nama_desa)) }}</td>
  </tr>
  <tr>
    <td><b><u>DURASI</b></u></td>
    <td><b><u>: {{ $transaksi->lama_kost }} Tahun</b></u></td>
    <td><b><u>TOTAL BIAYA</b></u></td>
    <td><b><u>: {{ $pustaka->rupiah($transaksi->harga) }}</b></u></td>
  </tr>
{{--   <tr>
  	<td></td>
  	<td>
  		<a href="javascript:void(0)" onclick="modalDeskripsi('{{ $kos->id }}')">
          <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Deskripsi">
            <i class="material-icons">description</i>
            Deskripsi
          </button>
        </a>
  	</td>
  	<td>
        <div id="mediaLibrary{{ $kos->id }}">
          @php
          $i = 1;
          @endphp
          @foreach($kos->fotos as $foto)
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
              Foto
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
    <a target="_blank" href="https://www.google.com/maps/search/{{ $kos->latitude }},{{ $kos->longitude }}">
      <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Google Maps">
        <i class="material-icons">place</i>
        Google Maps
      </button>
    </a>
    </td>
  </tr> --}}
</table>

<p>Jika ini adalah kesalahan, silakan <a href="{{route('hubungiKami')}}">hubungi kami</a></p>