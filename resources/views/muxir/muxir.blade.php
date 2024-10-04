@extends('layouts.layout')
@section('title',"Muxirlar")
@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Muhirlar</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active">Mavjud muxirlar</li>
    </ol>
  </nav>
</div>
<div class="row mb-3">
  <div class="col-3"><a href="{{ route('muxir') }}" class="btn btn-primary w-100">Mavjud muxirlar</a></div>
  <div class="col-3"><a href="{{ route('muxir_korzinka') }}" class="btn btn-secondary w-100">Korzinka muxirlar</a></div>
  <div class="col-3"><a href="{{ route('muxir_new') }}" class="btn btn-secondary w-100">Yangi muxir</a></div>
  <div class="col-3"><a href="{{ route('muxir_new_two') }}" class="btn btn-secondary w-100">Yangi muxir 2</a></div>
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
    <div class="card-body">   
      <h4 class="card-title w-100 text-center">Mavjud muxirlar</h4> 
      <table class="table text-center table-striped table-bordered datatable">
        <thead>
          <tr>
            <th class="bg-primary text-white text-center">Muxir raqami</th>
            <th class="bg-primary text-white text-center">Ro'yhatga olindi</th>
            <th class="bg-primary text-white text-center">Operator</th>
            <th class="bg-primary text-white text-center">Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($Muxir as $item)
          <tr>
            <td>{{ $item['number'] }}</td>
            <td>{{ $item['created_at'] }}</td>
            <td>{{ $item['meneger'] }}</td>
            <td>
              <form action="" method="post" style="display:inline">
                <input type="hidden" name="id" value="{{ $item['id'] }}">
                <button type="submit" class="btn btn-primary p-0 px-1"><i class="bi bi-plus"></i></button>
              </form>
              <form action="" method="post" style="display:inline">
                <input type="hidden" name="id" value="{{ $item['id'] }}">
                <button type="submit" class="btn btn-danger p-0 px-1"><i class="bi bi-trash"></i></button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan=4 class="text-center">Muxirlar mavjud emas</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</section>

</main>
@endsection
