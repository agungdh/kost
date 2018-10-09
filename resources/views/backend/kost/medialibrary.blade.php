@extends('template.backend.template')

@section('nav')
@include('backend.kost.nav')
@endsection

@section('content')
<div class="row clearfix">
    <div class="card">
        <div class="header">
            <h2>
                MEDIA LIBRARY
            </h2>
        </div>
        <div class="body">
            {!! Form::open(['route' => ['kost.doMediaLibrary', $id], 'files' => true, 'method' => 'put']) !!}

                <div class="body">
                    <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                        
                        @php
                        $i = 1;
                        @endphp
                        @foreach($fotos as $item)
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            @php
                            if (file_exists(storage_path('app/public/foto/kos/' . $item->id))) {
                                $url = asset('storage/foto/kos/' . $item->id);
                            } else {
                                $url = asset('assets/img/sorry-no-image-available.png');
                            }
                            @endphp
                            <a href="{{ $url }}" data-sub-html="{{ $item->deskripsi }}">
                                <img class="img-responsive thumbnail" src="{{ $url }}">
                            </a>

                            <label for="foto_{{ $i }}">Foto {{ $i }}</label>
                            <div class="form-group">
                                @php
                                $class = $errors->has('foto_' . $i) ? 'form-line error focused' : 'form-line';
                                $message = $errors->has('foto_' . $i) ? '<label class="error">' . $errors->first('foto_' . $i) . '</label>' : '';
                                @endphp
                                <div class="{{ $class }}">
                                    {!!
                                        Form::file(
                                            'foto_' . $i,  
                                            [
                                                'class'=> 'form-control', 
                                                'id' => 'foto_' . $i, 
                                                'placeholder'=>'Foto ' . $i,
                                            ])
                                    !!}
                                </div>
                                {!! $message !!}
                            </div>

                            <label for="deskripsi_{{ $i }}">Deskripsi {{ $i }}</label>
                            <div class="form-group">
                                @php
                                $class = $errors->has('deskripsi_' . $i) ? 'form-line error focused' : 'form-line';
                                $message = $errors->has('deskripsi_' . $i) ? '<label class="error">' . $errors->first('deskripsi_' . $i) . '</label>' : '';
                                @endphp
                                <div class="{{ $class }}">
                                    {!!
                                        Form::text(
                                            'deskripsi_' . $i, 
                                            null, 
                                            [
                                                'class'=> 'form-control', 
                                                'id' => 'deskripsi_' . $i, 
                                                'placeholder'=>'Deskripsi ' . $i,
                                            ])
                                    !!}
                                </div>
                                {!! $message !!}
                            </div>
                        </div>
                        @php
                        $i++;
                        @endphp
                        @endforeach

                    </div>
                </div>

                <button type="submit" class="btn btn-success waves-effect">SIMPAN</button>
                <a href="{{ route('kost.index') }}" class="btn btn-primary waves-effect">BATAL</a>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection