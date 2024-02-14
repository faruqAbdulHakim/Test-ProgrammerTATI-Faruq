@extends('layout.main')
@section('content')
  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Test 3</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 col-lg-5 col-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Predikat Kinerja Karyawan</h3>
              </div>
              <form action="{{ route('test.3') }}" method="POST" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label for="hasil_kerja" class="col-sm-3 col-form-label">Hasil Kerja</label>
                    <div class="col-sm-9">
                      <select class="custom-select rounded-0" name="hasil_kerja" id="hasil_kerja">
                        <option value="0">Dibawah Ekspektasi</option>
                        <option value="1">Sesuai Ekspektasi</option>
                        <option value="2">Diatas Ekspektasi</option>
                      </select>
                    </div>
                    @error('hasil_kerja')
                      <div class="col-12">
                        <small>{{ $message }}</small>
                      </div>
                    @enderror
                  </div>
                  <div class="form-group row">
                    <label for="perilaku" class="col-sm-3 col-form-label">Perilaku</label>
                    <div class="col-sm-9">
                      <select class="custom-select rounded-0" name="perilaku" id="perilaku">
                        <option value="0">Dibawah Ekspektasi</option>
                        <option value="1">Sesuai Ekspektasi</option>
                        <option value="2">Diatas Ekspektasi</option>
                      </select>
                    </div>
                    @error('perilaku')
                      <div class="col-12">
                        <small>{{ $message }}</small>
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-6 col-lg-5 col-xl-4">
            <div class="card">
              <div class="card-body">
                <div class="form-group">
                  <label for="input">Output</label>
                  @if (isset($data))
                    <p>{{ $data }}</p>
                  @else
                    <p>Isi Form terlebih dahulu</p>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
@endsection
