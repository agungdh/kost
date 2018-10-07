@extends('template.backend.template')

@section('content')
<div class="row clearfix">
  <div class="card">
      <div class="header">
          <h2>
              DATA CV/PT
          </h2>
      </div>
      <div class="body">
          <div class="button-demo">
            <a href="{{ route('kost.create') }}">
              <button type="button" class="btn bg-blue waves-effect">
                <i class="material-icons">add</i>Tambah CV/PT
              </button>
            </a>
          </div>
          <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                  <thead>
                      <tr>
                          <th style="text-align: center;">Nama Perusahaan</th>
                          <th style="text-align: center;">Proses</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td>asfas</td>
                          <td style="text-align: center;">
                            <a href="{{ route('dashboard') }}">
                              <button type="button" class="btn bg-blue waves-effect" data-toggle="tooltip" data-placement="top" title="Ubah">
                                <i class="material-icons">edit</i>
                              </button>
                            </a>
                            <a href="javascript:void(0)">
                              <button type="button" class="btn bg-red waves-effect" onclick="hapus()" data-toggle="tooltip" data-placement="top" title="Hapus">
                                <i class="material-icons">delete</i>
                              </button>
                            </a>
                          </td>
                      </tr>
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
$(function () {
    $('.js-basic-example').DataTable({
        responsive: true
    });
});

function hapus(id) {
    swal({
        title: 'Apakah anda yakin?',
        text: "Data akan dihapus!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Hapus!'
    }, function(result) {
        if (result) {
            window.location = "";
        }
    });
};

$('[data-toggle="tooltip"]').tooltip({
    container: 'body'
});
</script>
@endsection