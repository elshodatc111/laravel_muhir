@extends('layouts.layout')
@section('title',"Yangi muxir 2")
@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Muhirlar</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active">Yangi muxir 2</li>
    </ol>
  </nav>
</div>
<div class="row mb-3">
  <div class="col-3"><a href="{{ route('muxirs') }}" class="btn btn-secondary w-100">Mavjud muxirlar</a></div>
  <div class="col-3"><a href="{{ route('muxir_korzinka') }}" class="btn btn-secondary w-100">Korzinka muxirlar</a></div>
  <div class="col-3"><a href="{{ route('muxir_new') }}" class="btn btn-secondary w-100">Yangi muxir</a></div>
  <div class="col-3"><a href="{{ route('muxir_new_two') }}" class="btn btn-primary w-100">Yangi muxir 2</a></div>
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
      <form action="{{ route('muxir_new_create_two') }}" method="post">
        @csrf 
        <h4 class="card-title w-100 text-center">Yangi muxir kiritish</h4>
        <div class="row">
          <div class="col-4">
            <input type="number" required name="number1" placeholder="Start Number" class="form-control">
          </div>
          <div class="col-4">
            <input type="number" required name="number2" placeholder="End Number" class="form-control">
          </div>
          <div class="col-4">
            <button class="btn btn-primary w-100" type="submit">Saqlash</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

</main>
@endsection
