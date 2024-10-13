@extends('layouts.layout2')
@section('title',"Bo'limlar")
@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Bo'lim</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('bolim') }}">Barcha bo'limlar</a></li>
      <li class="breadcrumb-item active">Bo'lim</li>
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
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">   
          <h4 class="w-100 text-center card-title">Bo'lim haqida</h4>
          <form action="{{ route('bolim_update') }}" method="post">
            @csrf 
            <input type="hidden" name="id" value="{{ $Bolim['id'] }}">
            <label for="coato" class="mb-2">Bo'lim kodi</label>
            <input type="number" name="coato" value="{{ $Bolim['coato'] }}" required disabled class="form-control">
            <label for="name" class="my-2">Bo'lim nomi</label>
            <input type="text" name="name" value="{{ $Bolim['name'] }}" required class="form-control">
            <label for="about" class="my-2">Bo'lim haqida</label>
            <textarea type="text" name="about" required class="form-control">{{ $Bolim['about'] }}</textarea>
            <div class="w-100 text-center mt-2">
              <button type="submit" class="btn btn-primary">Bo'lim ma'lumotlarini yangilash</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">   
          <h4 class="w-100 text-center card-title">Bo'limga yangi hodim qo'shish</h4>
          <form action="{{ route('bolim_hodim_create') }}" method="post">
            @csrf 
            <input type="hidden" name="id" value="{{ $Bolim['id'] }}">
            <label for="name" class="mb-2">Hodimning FIO</label>
            <input type="text" name="name" required class="form-control">
            <label for="phone" class="my-2">Hodimning telefon raqami</label>
            <input type="text" name="phone" required class="form-control">
            <label for="about" class="my-2">Hodim haqida</label>
            <textarea type="text" name="about" required class="form-control"></textarea>
            <div class="w-100 text-center mt-2">
              <button type="submit" class="btn btn-primary">Yangi hodimni saqlash</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="card recent-sales overflow-auto">
    <div class="card-body">   
      <h4 class="w-100 text-center card-title">Bo'lim barcha hodimlari</h4>
      <table class="table text-center table-striped table-bordered">
        <thead>
          <tr>
            <th class="bg-primary text-white text-center">#</th>
            <th class="bg-primary text-white text-center">Hodim FIO</th>
            <th class="bg-primary text-white text-center">Telefon raqam</th>
            <th class="bg-primary text-white text-center">Hodim haqida</th>
            <th class="bg-primary text-white text-center">Status</th>
            <th class="bg-primary text-white text-center">Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($Hodim as $item)
            <tr>
              <td>{{ $loop->index+1 }}</td>
              <td>{{ $item['name'] }}</td>
              <td>{{ $item['phone'] }}</td>
              <td>{{ $item['about'] }}</td>
              <td>
                @if($item['status']=='true')
                  <span class="bg-success px-1 text-white">Aktiv</span>
                @else
                  <span class="bg-danger px-1 text-white">Bloklandi</span>
                @endif
              </td>
              <td>
                @if($item['status']=='true')
                  <form action="{{ route('bolim_hodim_lock') }}" method="post">
                    @csrf 
                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                    <button class="btn btn-danger p-0 px-1"><i class="bi bi-lock"></i></button>
                  </form>
                @else
                  <form action="{{ route('bolim_hodim_lock') }}" method="post">
                    @csrf 
                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                    <button class="btn btn-success p-0 px-1"><i class="bi bi-unlock"></i></button>
                  </form>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan=6 class="text-center">Bo'lim hodimlari mavjud emas.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
      <div class="w-100 text-center">
        <a href="{{ route('bolim_show_pdf',$Bolim->coato) }}" class="btn btn-info text-white">Majburiyatnomalar</a>
      </div>
    </div>
  </div>


</section>

</main>
@endsection
