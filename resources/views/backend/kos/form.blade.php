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

<label for="lat">Latitude</label>
<a href="javascript:void(0)" onclick="getLocation()">
  <i class="material-icons">my_location</i>
</a>
{!!
    Form::adhText(
        'Latitude',
        'lat',
        false
    )
!!}

<label for="lng">Longitude</label>
<a href="javascript:void(0)" onclick="getLocation()">
  <i class="material-icons">my_location</i>
</a>
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

{!!
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

{!!
    Form::adhText(
        'Biaya Tahunan',
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

{!!
    Form::adhTextArea(
        'Deskripsi',
        'deskripsi'
    )
!!}