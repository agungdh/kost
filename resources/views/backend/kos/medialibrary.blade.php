@extends('template.backend.template')

@section('nav')
@include('backend.kos.nav')
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
                <div class="body">
                    <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                        
                        @php
                        $i = 1;
                        @endphp
                        @foreach($fotos as $item)

                        {!! Form::hidden($i, $item->id) !!}

                        <div class="col-md-12">
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
                                            $item->deskripsi, 
                                            [
                                                'class'=> 'form-control', 
                                                'id' => 'deskripsi_' . $i, 
                                                'placeholder'=>'Deskripsi ' . $i,
                                                'disabled' => 'disabled',
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

                <a href="{{ route('kos.index') }}" class="btn btn-primary waves-effect">KEMBALI</a>
        </div>
    </div>
</div>
@endsection