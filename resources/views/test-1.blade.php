@extends('layout.main')
@section('content')
  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Test 1</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <a href="{{ route('test.1.create') }}" class="btn btn-primary">
          <i class="fa fa-plus"></i>
          Tambah Data
        </a>
        <div class="row mt-3">
          <div class="col-12 col-md-11 col-lg-10 col-xl-9">
            <div class="card card-info">
              {{-- Log Pribadi --}}
              <div class="card-header">
                <h3 class="card-title">Log saya</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th class="w-100">Log</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($employeeLogs as $log)
                      <tr>
                        <td>{{ $log->date }}</td>
                        <td>{{ $log->log }}</td>
                        <td>
                          <span
                            class="font-weight-bold text-sm rounded px-2 py-1 {{ $log->status == 'Pending' ? 'bg-warning' : ($log->status == 'Disetujui' ? 'bg-success' : 'bg-danger') }}">
                            {{ $log->status }}
                          </span>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            {{-- End Log Pribadi --}}

            {{-- Log Bawahan --}}
            <div class="card card-info">

              <div class="card-header">
                <h3 class="card-title">Log Bawahan</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Nama</th>
                      <th class="w-100">Log</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($subordinateLogs as $log)
                      <tr>
                        <td>{{ $log->date }}</td>
                        <td>{{ $log->subordinate }}</td>
                        <td>{{ $log->log }}</td>
                        <td>
                          <span
                            class="font-weight-bold text-sm rounded px-2 py-1 {{ $log->status == 'Pending' ? 'bg-warning' : ($log->status == 'Disetujui' ? 'bg-success' : 'bg-danger') }}">
                            {{ $log->status }}
                          </span>
                          <button type="button" data-toggle="modal" data-target="#modal-delete-{{ $log->id }}"
                            class="btn btn-sm btn-danger ml-2">
                            <i class="fa fa-trash"></i>
                          </button>
                          <button type="button" data-toggle="modal" data-target="#modal-edit-{{ $log->id }}"
                            class="btn btn-sm btn-info ml-2">
                            <i class="fa fa-pen"></i>
                          </button>
                        </td>
                      </tr>

                      {{-- Modal Delete --}}
                      <div class="modal fade" id="modal-delete-{{ $log->id }}">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <p>Apakah anda yakin ingin menghapus Log ini</b></p>
                            </div>
                            <div class="modal-footer justify-end">
                              <form action="{{ route('test.1.delete', ['id' => $log->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Hapus</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      {{-- End of Modal --}}

                      {{-- Modal Edit --}}
                      <div class="modal fade" id="modal-edit-{{ $log->id }}">
                        <div class="modal-dialog">
                          <form action="{{ route('test.1.edit', ['id' => $log->id]) }}" method="POST">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Ubah Data</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="form-group row">
                                  <label for="status" class="col-sm-3 col-form-label">Status</label>
                                  <div class="col-sm-9">
                                    <select class="custom-select rounded-0" name="status" id="status">
                                      <option value="Pending">Pending</option>
                                      <option value="Disetujui">Disetujui</option>
                                      <option value="Ditolak">Ditolak</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer justify-end">
                                @csrf
                                @method('PUT')
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-info">Simpan</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                      {{-- End of Modal --}}
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            {{-- End Log Bawahan --}}
          </div>
        </div>
      </div>
  </div>
  </section>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  @if ($message = Session::get('success'))
    <script>
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

      Toast.fire({
        icon: 'success',
        title: '{{ $message }}'
      })
    </script>
  @endif

  @if ($message = Session::get('error'))
    <script>
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
      });

      Toast.fire({
        icon: 'error',
        title: '{{ $message }}'
      })
    </script>
  @endif
@endsection
