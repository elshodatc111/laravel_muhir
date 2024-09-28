@extends('layouts.layout')

@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Yangi muxir</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Muhir</a></li>
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Mavjud muxirlar</a></li>
      <li class="breadcrumb-item active">Yangi muxir</li>
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
      <div class="row">
        <h5 class="card-title w-100 text-center">Yangi muhir raqami</h5>
        <form action="{{ route('home_story') }}" method="post">
          @csrf 
          <input type="text" required name="number" value="{{ old('number') }}" class="form-control">
          @error('number')
            <span class="text-danger w-100 mt-0 pt-0">Muxir oldin kiritilgan.</span><br>
          @enderror
        </form>
      </div>
    </div>
  </div>
</section>

</main>
@endsection
