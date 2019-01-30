@extends('template.backend.template')

@section('nav')
@include('backend.masterfasilitas.nav')
@endsection

@section('content')
<div class="row clearfix">
    <div class="card">
        @adhHeader([
            'title' => 'UBAH MASTER FASILITAS',
          ])
        @endadhHeader
        <div class="body">
            {!! Form::model($masterfasilitas, ['route' => ['masterfasilitas.update',$masterfasilitas->id], 'method' => 'put']) !!}

                @include('backend.masterfasilitas.form')

                <button type="submit" class="btn btn-success waves-effect">SIMPAN</button>
                <a href="{{ route('masterfasilitas.index') }}" class="btn btn-primary waves-effect">BATAL</a>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection