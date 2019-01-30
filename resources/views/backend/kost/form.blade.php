{!!
    Form::adhText(
        'Nama',
        'nama'
    )
!!}

{!!
    Form::adhText(
        'Alamat',
        'alamat'
    )
!!}

@adhLabel([
    'for' => 'lat',
    'title' => 'Latitude',
])
@endadhLabel
@adhaGetLocation()
@endadhaGetLocation
{!!
    Form::adhText(
        'Latitude',
        'lat',
        false
    )
!!}

@adhLabel([
    'for' => 'lng',
    'title' => 'Longitude',
])
@endadhLabel
@adhaGetLocation()
@endadhaGetLocation
{!!
    Form::adhText(
        'Longitude',
        'lng',
        false
    )
!!}

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

{{-- {!!
    Form::adhText(
        'Biaya Bulanan',
        'bulanan',  
        true,  
        null, 
        [
          'class' => 'form-control uang',
        ]
    )
!!}
 --}}
{!!
    Form::adhText(
        'Biaya Per Tahun',
        'tahunan',  
        true,  
        null, 
        [
          'class' => 'form-control uang',
        ]
    )
!!}

{!!
    Form::adhText(
        'Kamar Tersedia',
        'kamartersedia',  
        true,
        null, 
        [
          'class' => 'form-control uang',
        ]
    )
!!}

<div class="form-group">
    <select id="optgroup" class="ms" multiple="multiple" name="fasilitas[]">
        <optgroup label="Fasilitas">
        @php
        $fasilitasnya = [];
        if (isset($kost)) {
            $fasilitasnya_raw = \App\FasilitasKos::where('id_kos', $kost->id)->get();
            foreach ($fasilitasnya_raw as $value) {
                $fasilitasnya[] = $value->id_fasilitas;
            }
        }
        @endphp
        @foreach(\App\MasterFasilitas::all() as $mf)
        @if(in_array($mf->id, $fasilitasnya))
        <option selected value="{{$mf->id}}">{{$mf->fasilitas}}</option>
        @else
        <option value="{{$mf->id}}">{{$mf->fasilitas}}</option>
        @endif
        @endforeach
        </optgroup>
    </select>
</div>
        
{!!
    Form::adhTextArea(
        'Deskripsi',
        'deskripsi'
    )
!!}