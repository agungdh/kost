@extends('template.backend.template')

@section('nav')
@include('backend.masterfasilitas.nav')
@endsection

@section('content')
<div class="row clearfix">
  <div class="card">
      @adhHeader([
          'title' => 'DATA MASTER FASILITAS',
        ])
      @endadhHeader
      <div class="body">
          <div class="button-demo">
            <a href="{{ route('masterfasilitas.create') }}">
              <button type="button" class="btn bg-blue waves-effect">
                <i class="material-icons">add</i>Tambah Master Fasilitas
              </button>
            </a>
          </div>
          <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover datatable">
                  <thead>
                      <tr>
                          <th style="text-align: center;">Fasilitas</th>
                          <th style="text-align: center;">Proses</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($masterFasilitas as $item)
                      <tr>
                        <td>{{ $item->fasilitas }}</td>
                        <td>
                        <a href="{{ route('masterfasilitas.edit', $item->id) }}">
                          <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Ubah">
                            <i class="material-icons">edit</i>
                          </button>
                        </a>
                        {!! Form::open(['id' => 'formHapus' . $item->id, 'route' => ['masterfasilitas.destroy', $item->id], 'method' => 'delete']) !!}
                        <button type="button" class="btn bg-red waves-effect" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('{{ $item->id }}')">
                            <i class="material-icons">delete</i>
                          </button>
                        {!! Form::close() !!}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>
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
      $("#formHapus" + id).submit();
    });
  }
</script>
@endsection