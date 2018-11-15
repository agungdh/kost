@extends('template.backend.template')

@section('nav')
@include('backend.kost.nav')
@endsection

@section('content')
<div class="row clearfix">
    <div class="card">
        @adhHeader([
            'title' => 'MEDIA LIBRARY',
          ])
        @endadhHeader
        <div class="body">
            {!! Form::open(['route' => ['kost.doMediaLibrary', $id], 'files' => true, 'method' => 'put']) !!}

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

                            <div class="form-group">
                                <button type="button" class="btn btn-xs bg-red waves-effect" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('{{ $item->id }}')">
                                    <i class="material-icons">delete</i>
                                </button>
                            </div>

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
                                            $item->deskripsi, 
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

@section('js')
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
      window.location = "{{ route('kost.doDeletePhoto') }}?id=" + id;
    });
  }
</script>
@endsection