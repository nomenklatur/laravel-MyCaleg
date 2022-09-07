@extends('layout.base_layout')

@section('content')
    <div class="container mt-3">
      <div class="row">
        <div class="col-lg-6 mx-auto">
          <form action="/user/parties" method="post">
            @csrf
            <fieldset>
              <legend>Input informasi partai</legend>
              <div class="mb-3">
                <label for="nama" class="form-label">Nama singkat partai</label>
                <input type="text" class="form-control" id="nama" name="nama">
              </div>
              <div class="mb-3">
                <label for="kepanjangan" class="form-label">Nama lengkap partai</label>
                <input type="text" class="form-control" id="kepanjangan" name="kepanjangan">
              </div>
              <div class="mb-3">
                <label for="gambar" class="form-label">Logo partai/label>
                <input class="form-control" type="file" id="gambar" name="gambar">
              </div>
              <div class="d-grid gap-2">
                <button class="btn btn-success" type="Submit">Simpan</button>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
@endsection