@extends('layouts.layout')
@section('title',"Bo'limlar")
@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Bo'lim</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active">Barcha bo'limlar</li>
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
    <div class="card-body pt-4">   
      <table class="table text-center table-striped table-bordered">
        <thead>
          <tr>
            <th class="bg-primary text-white text-center">#</th>
            <th class="bg-primary text-white text-center">Bo'lim kodi</th>
            <th class="bg-primary text-white text-center">Bo'lim nomi</th>
            <th class="bg-primary text-white text-center">Hodimlar</th>
            <th class="bg-primary text-white text-center">Bo'lim haqida</th>
          </tr>
        </thead>
        <tbody>
          @forelse($Bolim as $item)
            <tr>
              <td>{{ $loop->index+1 }}</td>
              <td><a href="{{ route('bolim_show',$item['id']) }}">{{ $item['coato'] }}</a></td>
              <td style="text-align:left">{{ $item['name'] }}</td>
              <td></td>
              <td>{{ $item['about'] }}</td>
            </tr>
          @empty
            <tr>
              <td colspan=5 class="text-center">Bo'limlar mavjud emas</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="card recent-sales overflow-auto">
    <div class="card-body">
      <h2 class="card-title w-100 text-center">Yangi bo'lim qo'shish</h2>   
      <form action="{{ route('bolim_create') }}" method="post">
        @csrf 
        <label for="coato" class="mb-2">Bo'lim kodi</label>
        <input type="number" name="coato" required class="form-control">
        <label for="name" class="my-2">Bo'lim nomi</label>
        <input type="text" name="name" required class="form-control">
        <label for="about" class="my-2">Bo'lim haqida</label>
        <textarea type="text" name="about" required class="form-control"></textarea>
        <div class="w-100 text-center mt-2">
          <button type="submit" class="btn btn-primary">Yangi bo'limni saqlash</button>
        </div>
      </form>
    </div>
  </div>
</section>

</main>
@endsection
