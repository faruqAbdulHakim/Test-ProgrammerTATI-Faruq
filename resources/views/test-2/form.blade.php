@extends('layout.main')
@section('content')
  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">
              {{ $type == 'edit' ? 'Ubah' : 'Tambah' }}
              Data Provinsi
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
              <form
                action="{{ $type == 'edit' ? route('test.2.edit', ['id' => $province->id]) : route('test.2.create') }}"
                method="POST">
                @csrf
                @method($type == 'edit' ? 'PUT' : 'POST')
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_provinsi">Provinsi</label>
                    <input type="text" class="form-control" name="name" id="nama_provinsi"
                      placeholder="Masukkan provinsi" value="{{ isset($province) ? $province->name : '' }}">
                  </div>
                  @error('name')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                  <div class="form-group">
                    <label for="lat">Latitude</label>
                    <input type="text" class="form-control" name="lat" id="lat"
                      placeholder="Masukkan Latitude" value="{{ isset($province) ? $province->lat : '' }}">
                  </div>
                  @error('lat')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                  <div class="form-group">
                    <label for="lng">Longitude</label>
                    <input type="text" class="form-control" name="lng" id="lng"
                      placeholder="Masukkan Longitude" value="{{ isset($province) ? $province->lng : '' }}">
                  </div>
                  @error('lng')
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
