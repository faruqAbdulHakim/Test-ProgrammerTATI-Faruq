@extends('layout.main')
@section('content')

  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Test 4</h1>
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
                <h3 class="card-title">Deret Bilangan</h3>
              </div>
              <form action="{{ route('test.4') }}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="input">Input</label>
                    <input type="number" class="form-control" name="input" id="input" placeholder="Enter Number">
                  </div>
                  @error('input')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
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
                    <p>Input your number first</p>
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
