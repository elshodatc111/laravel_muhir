@extends('layouts.layout')

@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Tarqatilgan muxirlar</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Muxirlar</a></li>
      <li class="breadcrumb-item active">Tarqatilgan muxirlar</li>
    </ol>
  </nav>
</div>
@if (Session::has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-1"></i>
    {{Session::get('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@elseif (Session::has('error'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-1"></i>
    {{Session::get('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
<section class="section dashboard">
  <div class="card recent-sales overflow-auto">
    <div class="card-body pt-3">
      <table class="table text-center table-striped table-bordered datatable">
        <thead>
          <tr>
            <th class="bg-primary text-white text-center">#</th>
            <th class="bg-primary text-white text-center">Faktura raqam</th>
            <th class="bg-primary text-white text-center">Muxir raqami</th>
            <th class="bg-primary text-white text-center">Bo'lim</th>
            <th class="bg-primary text-white text-center">Muxirchi</th>
            <th class="bg-primary text-white text-center">Operator</th>
            <th class="bg-primary text-white text-center">Tarqatili</th>
          </tr>
        </thead>
        <tbody>
          @forelse($tarqatildi as $item)
            <tr>
              <td>{{ $loop->index+1 }}</td>
              <td><a href="{{ route('faktura_show',$item['faktura']) }}" >{{ $item['faktura'] }}</a></td>
              <td>{{ $item['number'] }}</td>
              <td>{{ $item['bolim'] }}</td>
              <td>{{ $item['muxirchi'] }}</td>
              <td>{{ $item['operator'] }}</td>
              <td>{{ $item['data'] }}</td>
            </tr>
          @empty
            <tr>
              <td colspan=7 class="text-center">Tarqatilgan muxirlar mavjud emas</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</section>

</main>
@endsection
