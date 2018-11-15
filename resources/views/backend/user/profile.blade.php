@extends('template.backend.template')

@section('nav')
@include('backend.user.nav')
<li><a href="{{ route('user.profile', $user->id) }}">Profil</a></li>
@endsection

@section('content')
<div class="row clearfix">
    <div class="card">
        @adhHeader([
            'title' => 'PROFIL',
          ])
        @endadhHeader
        <div class="body">
            {!! Form::model($user, ['route' => ['user.doProfile', $user->id], 'method' => 'put']) !!}

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

                {!!
                    Form::adhText(
                        'No HP',
                        'nohp'
                    )
                !!}

                {!!
                    Form::adhSelect2(
                        'Verifikasi No HP',
                        'verified_nohp', 
                        true,
                        [
                            'y' => 'Terverifikasi',
                            'n' => 'Belum Terverifikasi',
                        ], 
                        null, 
                        []
                    )
                !!}

                {!!
                    Form::adhSelect2(
                        'Status',
                        'active', 
                        true,
                        [
                            'y' => 'Aktif',
                            'n' => 'Belum Aktif',
                        ], 
                        null, 
                        []
                    )
                !!}
                
                <button type="submit" class="btn btn-success waves-effect">SIMPAN</button>
                <a href="{{ route('user.index') }}" class="btn btn-primary waves-effect">BATAL</a>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection