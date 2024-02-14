@extends('layout.main')
@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Test 2 (API Provinsi)</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <a href="{{ route('test.2.create') }}" class="btn btn-primary">
          <i class="fa fa-plus"></i>
          Tambah Data
        </a>
        <div class="row mt-3">
          <div class="col-12">
            <div class="card">
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nama Provinsi</th>
                      <th>Lat</th>
                      <th>Lang</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($provinces as $province)
                      <tr>
                        <td>{{ $province->id }}</td>
                        <td>{{ $province->name }}</td>
                        <td>{{ $province->lat }}</td>
                        <td>{{ $province->lng }}</td>
                        <td>
                          <button type="button" class="btn btn-danger" title="delete" data-toggle="modal"
                            data-target="#modal-delete-{{ $province->id }}">
                            <i class="fa fa-trash"></i>
                          </button>
                          <a href="{{ route('test.2.edit', ['id' => $province->id]) }}" class="btn btn-primary"
                            title="Edit">
                            <i class="fa fa-pen"></i>
                          </a>
                        </td>
                        <div class="modal fade" id="modal-delete-{{ $province->id }}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <p>Apakah anda yakin ingin menghapus data provinsi <b>{{ $province->name }}</b></p>
                              </div>
                              <div class="modal-footer justify-end">
                                <form action="{{ route('test.2.delete', ['id' => $province->id]) }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                  <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @if ($message = Session::get('delete-failed'))
    <script>
      Swal.fire('{{ $message }}')
    </script>
  @endif
  @if ($message = Session::get('delete-success'))
    <script>
      Swal.fire({
        icon: 'success',
        text: '{{ $message }}',
      })
    </script>
  @endif
@endsection
