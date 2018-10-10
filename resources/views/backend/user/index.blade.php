@extends('template.backend.template')

@section('nav')
@include('backend.user.nav')
@endsection

@section('content')
<div class="row clearfix">
  <div class="card">
      <div class="header">
          <h2>
              DATA USER
          </h2>
      </div>
      <div class="body">
          <div class="button-demo">
            <a href="{{ route('user.create') }}">
              <button type="button" class="btn bg-blue waves-effect">
                <i class="material-icons">add</i>Tambah User
              </button>
            </a>
          </div>
          <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover datatable">
                  <thead>
                      <tr>
                          <th style="text-align: center;">Email</th>
                          <th style="text-align: center;">Nama</th>
                          <th style="text-align: center;">Alamat</th>
                          <th style="text-align: center;">No HP</th>
                          <th style="text-align: center;">Level</th>
                          <th style="text-align: center;">Status</th>
                          <th style="text-align: center;">Proses</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                      <tr>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->alamat }}</td>
                        <td>{{ $user->nohp }}</td>
                        <td>{{ $user->level == 'a' ? 'Admin' : 'Pemilik Kos' }}</td>
                        <td>{{ $user->active == 'y' ? 'Aktif' : 'Belum Aktif' }}</td>
                          <td style="text-align: center;">
                                                        
                            <a href="{{ route('user.profile', $user->id) }}">
                              <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Profil">
                                <i class="material-icons">person</i>
                              </button>
                            </a>

                            <a href="{{ route('user.chpass', $user->id) }}">
                              <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Ubah Password">
                                <i class="material-icons">lock</i>
                              </button>
                            </a>

                            <a href="{{ route('user.chemail', $user->id) }}">
                              <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Ubah Email">
                                <i class="material-icons">mail</i>
                              </button>
                            </a>

                            <a href="{{ route('user.foto', $user->id) }}">
                              <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Ubah Foto">
                                <i class="material-icons">image</i>
                              </button>
                            </a>

                            {!! Form::open(['id' => 'formHapus' . $user->id, 'route' => ['user.destroy', $user->id], 'method' => 'delete']) !!}
                            <button type="button" class="btn bg-red waves-effect" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('{{ $user->id }}')">
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
      text: "Setelah dihapus data tidak dapt dikembalikan!",
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