@extends('template.backend.template')

@section('nav')
@include('backend.user.nav')
@endsection

@section('content')
<div class="row clearfix">
    <div class="card">
        <div class="header">
            <h2>
                TAMBAH USER
            </h2>
        </div>
        <div class="body">
            {!! Form::open(['route' => 'user.store']) !!}

                {!!
                    Form::adhText(
                        'Email',
                        'email'
                    )
                !!}

                {!!
                    Form::adhPassword(
                        'Password',
                        'password'
                    )
                !!}
                
                {!!
                    Form::adhPassword(
                        'Ulangi Password',
                        'password_confirmation'
                    )
                !!}

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
                        'Level',
                        'level', 
                        true,
                        [
                            'a' => 'Admin',
                            'p' => 'Pemilik Kos',
                            'u' => 'Pencari Kos',
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

@section('js')
<script type="text/javascript">
    $("#level").select2();
</script>
@endsection