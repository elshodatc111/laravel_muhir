@extends('layouts.layout')
@section('title',"Naryad")
@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Yangi naryad</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('naryad') }}">Mavjud Naryadlar</a></li>
      <li class="breadcrumb-item active">Yangi naryad</li>
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
    <div class="card-body">   
      <h4 class="card-title w-100 text-center">Yangi naryad</h4>
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <form action="{{ route('naryad_create_story') }}" method="post" enctype="multipart/form-data">
        @csrf 
        <div class="row">
          <div class="col-6">
            <label for="coato" class="mb-1">Tuman(Shahar)</label>
            <select name="coato" required class="form-select">
              <option value="">Tanlang...</option>
              @foreach($Bolim as $item)
              <option value="{{ $item['coato'] }}">{{ $item['name'] }}</option>
              @endforeach
            </select>
            <label for="naryad_number" class="mt-2 mb-1">Naryad raqami (min:5)</label>
            <input type="number" name="naryad_number" value="{{ old('naryad_number') }}" required class="form-control">
            <label for="naryad_type" class="mt-2 mb-1">Naryad turi</label>
            <select name="naryad_type" required class="form-select">
              <option value="">Tanlang...</option>
              <option value="new">Yangi istemolchi</option>
              <option value="reset">Qayta muxirlash</option>
              <option value="reset_meter">Hisoblagich almashtirish</option>
            </select>
            <label for="user_type" class="mt-2 mb-1">Istemolchi turi</label>
            <select name="user_type" required class="form-select">
              <option value="">Tanlang...</option>
              <option value="axoli">Axoli</option>
              <option value="yuridik">Yuridik</option>
            </select>
          </div>
          <div class="col-6">
            <label for="user_number" class="mb-1">Istemolchi hisob raqam (min:6)</label>
            <input type="number" name="user_number" value="{{ old('user_number') }}" required class="form-control">
            <label for="old_meter_number" class="mt-2 mb-1">Eski hisoblagich raqami (min:7)</label>
            <input type="number" name="old_meter_number" value="{{ old('old_meter_number') }}" class="form-control">
            <label for="new_meter_number" class="mt-2 mb-1">Yangi hisoblagich raqami (min:6, max:12)</label>
            <input type="number" name="new_meter_number" value="{{ old('new_meter_number') }}" required class="form-control">
            <label for="naryad_file" class="mt-2 mb-1">Naryad nushasi(PDF, max:5MB)</label>
            <input type="file" name="naryad_file" required class="form-control">
          </div>
          <div class="col-12 text-center"> 
            <label for="about" class="mt-2 mb-1">Naryad haqida</label>
            <textarea name="about" class="form-control">{{ old('about') }}</textarea>
            <button type="submit" class="btn btn-primary w-50 mt-3">Saqlash</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

</main>
@endsection
