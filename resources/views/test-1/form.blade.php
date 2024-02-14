@extends('layout.main')
@section('content')
  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">
              {{ $type == 'edit' ? 'Ubah' : 'Tambah' }}
              Log
            </h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <div class="card card-primary">
              <form action="{{ $type == 'edit' ? route('test.1.edit', ['id' => $log->id]) : route('test.1.create') }}"
                method="POST">
                @csrf
                @method($type == 'edit' ? 'PUT' : 'POST')
                <div class="card-body">
                  <div class="form-group">
                    <label for="date">Tanggal</label>
                    <input type="date" class="form-control" name="date" id="date"
                      value="{{ isset($log) ? $log->date : '' }}">
                  </div>
                  @error('date')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                  <div class="form-group">
                    <label for="log">Log</label>
                    <textarea rows="10" class="form-control" name="log" id="log"
                      value="{{ isset($log) ? $log->log : '' }}"></textarea>
                  </div>
                  @error('log')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
@endsection
