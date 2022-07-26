@extends('layout.base_layout')

@section('content')
    <div class="container mt-5 text-center">
      <h2>Daerah Pemilihan {{ $dapil[0]->dapil->id }}</h2>
      <h5>Kecamatan {{ $dapil[0]->dapil->kecamatan}}</h5>
    </div>
    <div class="container mt-5 mb-5">
      <div class="row">
        @foreach ($party as $item)
        <div class="col-md-3 mb-3">
          <div class="card border-dark rounded" style="width: 16rem;">
            <img src="@if ($item->gambar != null) {{ asset('storage/'.$item->gambar) }} @else /images/party.png @endif" class="card-img-top" alt="..." style="width:100%; height:140px;">
            <div class="card-body">
              <div class="card-header">
                <h5 class="text-center">{{$item->nama}}</h5>
              </div>
              <ul class="list-group list-group-flush">
                @foreach ($dapil as $caleg)
                    @if ($caleg->party->nama == $item->nama)
                        <li class="list-group-item">{{$caleg->nama}}</li>
                    @endif
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
@endsection