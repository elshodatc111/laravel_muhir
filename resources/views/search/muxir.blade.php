@extends('layouts.layout')
@section('title',"Home")
@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Muhirlar</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Muhir</a></li>
      <li class="breadcrumb-item active">Mavjud muxirlar</li>
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
<div class="row mb-3">
  <div class="col-3"><a href="{{ route('qidruv_muxir') }}" class="btn btn-primary w-100">Muxirlar</a></div>
  <div class="col-3"><a href="{{ ROUTE('qidruv_naryad_blanka') }}" class="btn btn-secondary w-100">Naryad (blanka)</a></div>
  <div class="col-3"><a href="{{ ROUTE('qidruv_simkarta') }}" class="btn btn-secondary w-100">Sim kartalar</a></div>
  <div class="col-3"><a href="{{ ROUTE('qidruv_naryadlar') }}" class="btn btn-secondary w-100">Naryadlar</a></div>
</div>
<section class="section dashboard">
  <div class="card recent-sales overflow-auto">
    <div class="card-body">   
      <table class="table text-center table-striped table-bordered datatable">
        <thead>
          <tr>
            <th class="bg-primary text-white text-center">#</th>
            <th class="bg-primary text-white text-center">Muxir raqami</th>
            <th class="bg-primary text-white text-center">Hisob faktura raqami</th>
            <th class="bg-primary text-white text-center">Bo'lim</th>
            <th class="bg-primary text-white text-center">Masul hodim</th>
            <th class="bg-primary text-white text-center">Operator</th>
            <th class="bg-primary text-white text-center">Tarqatildi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($Muxir as $item)
          <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{ $item['number'] }}</td>
            <td><a href="{{ route('muxir_faktura_show',$item['faktura']) }}"> № - {{ $item['faktura'] }}</a></td>
            <td>{{ $item['coato_name'] }}</td>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['operator'] }}</td>
            <td>{{ $item['created_at'] }}</td>
          </tr>
          @empty
          <tr><td colspan=7 class="text-center">Tarqatilgan muxirlar mavjud emas.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</section>

</main>
@endsection
