@extends('layouts.layout')

@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Yangi bo'lim</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('bolim') }}">Bo'limlar</a></li>
      <li class="breadcrumb-item active">Yangi bo'lim</li>
    </ol>
  </nav>
</div>

<section class="section dashboard">
  <div class="card recent-sales overflow-auto">
    <div class="card-body">
      <div class="row">
        <div class="col-6">
          <h5 class="card-title">Yangi bo'lim qo'shish</h5>
        </div>
        <div class="col-12">
          <form action="{{ route('create_bolim_story') }}" method="post">
            @csrf 
            <label for="coato" class="mb-2">Bo'lim kodi</label>
            <input type="number" class="form-control" name="coato" value="{{ old('coato') }}" required >
            @error('coato')
              <span class="text-danger w-100 mt-0 pt-0">Bo'lim kodi mavjud yoki 5 ta raqamdan iborat emas.</span><br>
            @enderror
            <label for="name" class="my-2">Bo'lim nomi</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required >
            @error('name')
              <span class="text-danger w-100" style="font-size:10px;">Bo'lim nomi mavjud.</span>
            @enderror
            <button class="btn btn-primary w-100 mt-3">Bo'limni saqlash</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

</main>
@endsection
