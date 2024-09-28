@extends('layouts.layout2')

@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Bo'lim</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('bolim') }}">Bo'limlar</a></li>
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
          <h4 class="card-title">Bo'lim haqida</h4>
          <form action="{{ route('create_bolim_update') }}" method="post">
            @csrf 
            <div class="row">
              <div class="col-6">
                <input type="hidden" name="id" value="{{ $Bolim['id'] }}">
                <label for="coato" class="mb-2">Bo'lim holati</label>
                <input type="text" class="form-control" value="{{ $Bolim['status']=='true' ? 'Active' : 'Bloklangan' }}" required disabled>
              </div>
              <div class="col-6">
                <label for="coato" class="mb-2">Bo'lim kodi</label>
                <input type="number" class="form-control" name="coato" value="{{ $Bolim['coato'] }}" required disabled>
              </div>
            </div>
            <label for="name" class="my-2">Bo'lim nomi</label>
            <input type="text" class="form-control" name="name" value="{{ $Bolim['name'] }}" required >
            @error('name')
              <span class="text-danger w-100" style="font-size:10px;">Bo'lim nomi mavjud.</span>
            @enderror
            <label for="status" class="my-2">Bo'lim holati</label>
            <select name="status" class="form-select" required>
              <option value="">Tanlang</option>
              <option value="true">Activ</option>
              <option value="false">Bloklash</option>
            </select>
            <button type="submit" class="btn btn-primary w-100 mt-3">Yangilanishni saqlash</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Yangi hodim qo'shish</h4>
          <form action="{{ route('create_bolim_create_hodim') }}" method="post">
            @csrf 
            <input type="hidden" name="coato" value="{{ $Bolim['coato'] }}">
            <label for="fio" class="my-2">FIO</label>
            <input type="text" class="form-control" name="fio" required >
            <label for="phone" class="my-2">Telefon raqam</label>
            <input type="text" class="form-control" name="phone" required >
            <label for="lavozim" class="my-2">Lavozimi</label>
            <input type="text" class="form-control" name="lavozim" required >
            <button type="submit" class="btn btn-primary w-100 mt-3">Yangi hodimni saqlash</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="card recent-sales overflow-auto">
    <div class="card-body">
      <h5 class="card-title">Bo'lim barcha hodimlari</h5>
      <table class="table text-center table-striped table-bordered datatable">
        <thead>
          <tr>
            <th class="bg-primary text-white text-center">#</th>
            <th class="bg-primary text-white text-center">FIO</th>
            <th class="bg-primary text-white text-center">Telefon raqam</th>
            <th class="bg-primary text-white text-center">Lavozimi</th>
            <th class="bg-primary text-white text-center">Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($Hodim as $item)
            <tr>
              <td>{{ $loop->index+1 }}</td>
              <td>{{ $item['fio'] }}</td>
              <td>{{ $item['phone'] }}</td>
              <td>{{ $item['lavozim'] }}</td>
              <td>
                @if($item['status']=='true')
                  <form action="{{ route('create_bolim_delete_hodim') }}" method="post">
                    @csrf 
                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                    <button class="p-0 px-1 btn btn-danger"><i class="bi bi-trash"></i></button>
                  </form>
                @else 
                  O'chirildi
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan=5 class="text-center">Hodimlar mavjud emas</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</section>

</main>
@endsection
