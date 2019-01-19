@extends('template.frontend.template')

@section('nav')
<li><a href="{{ route('root') }}">Home</a></li>
<li><a href="{{ route('pesan', $kos->id) }}">Pesan</a></li>
@endsection

@section('content')
<div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="header">
	  <h2>
	      PESAN
	  </h2>
	</div>
	<div class="body">
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
		  </tr>
		</table>
	</div>
	<div class="body">
        {!! Form::open(['route' => ['doPesan', $kos->id]]) !!}

        	{!!
			    Form::adhText(
			        'Jumlah Kamar',
			        'jumlah_kamar',
			        true,  
			        null, 
			        [
			          'class' => 'form-control uang',
			        ]
			    )
			!!}

        	{!!
			    Form::adhText(
			        'Lama Kost (Tahun)',
			        'lama_kost',
			        true,  
			        null, 
			        [
			          'class' => 'form-control uang',
			        ]
			    )
			!!}

{{-- 			{!!
			    Form::adhSelect2(
			        'Pembayaran',
			        'pembayaran', 
			        true,
			        [
			          'b' => 'Bulanan',
			          't' => 'Tahunan',
			        ]
			    )
			!!}
 --}}
			{!!
			    Form::adhText(
			        'Jumlah Yang Harus Dibayar',
			        'total',
			        true,  
			        null, 
			        [
			          'disabled' => 'true',
			          'class' => 'form-control uang',
			        ]
			    )
			!!}

            <button type="submit" class="btn btn-success waves-effect">SIMPAN</button>
            <button type="reset" class="btn btn-primary waves-effect">RESET</button>

        {!! Form::close() !!}
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
// $("#pembayaran").change(function() {
// 	hitung();
// });
$("#jumlah_kamar").keyup(function() {
	hitung();
});
$("#lama_kost").keyup(function() {
	hitung();
});
</script>

<script type="text/javascript">
var varTotal = 0;
function hitung() {
	// if ($("#pembayaran").val() == 't') {
	// 	varTotal = $("#jumlah_kamar").cleanVal() * ($("#lama_kost").cleanVal() * {{ $kos->tahunan ?? 0 }});
	// } else if ($("#pembayaran").val() == 'b') {
	// 	varTotal = $("#jumlah_kamar").cleanVal() * ($("#lama_kost").cleanVal() * {{ $kos->bulanan ?? 0}});
	// } else {
	// 	varTotal = 0;
	// }
	varTotal = $("#jumlah_kamar").cleanVal() * ($("#lama_kost").cleanVal() * {{ $kos->tahunan ?? 0 }});
	$("#total").val(varTotal);
	$("#total").unmask();
	$( '#total' ).mask('000.000.000.000.000.000', {
        reverse: true
    });    
}
</script>

<script type="text/javascript">
$("form").submit(function(event) {
	event.preventDefault();

	if ($("#jumlah_kamar").cleanVal() > {{ $kos->kamartersedia }}) {
		swal('ERROR !!!', 'Kamar Tersedia Tidak Cukup !!!', 'error');

		return false;
	}

	if (varTotal == 0) {
		swal('ERROR !!!', 'Data Pemesanan Tidak Valid !!!', 'error');	
	
		return false;
	}

	$("form").unbind().submit();
})
</script>

<script type="text/javascript">
  function modalDeskripsi(id) {
    $("#modalBody").html(deskripsi[id]);
    $("#modalDeskripsi").modal('show');
  }
</script>

{{-- onload --}}
<script type="text/javascript">
$(function() {
	hitung();
  $("#mediaLibrary{{ $kos->id }}").lightGallery({thumbnail: true, selector: 'a'});
});  
</script>
<script type="text/javascript">
var deskripsi = [];
deskripsi[{{ $kos->id }}] = atob('{!! base64_encode($kos->deskripsi) !!}');
</script>
@endsection