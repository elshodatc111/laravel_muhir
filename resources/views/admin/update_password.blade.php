@extends('layouts.layout')

@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Parolni yangilash</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active">Parolni yangilash</li>
    </ol>
  </nav>
</div>
@if (session('status'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-1"></i>
    {{ session('status') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
@if (session('current_password'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-1"></i>
    {{ session('current_password') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
  <div class="row">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title w-100 text-center">Parolni yangilash</h4>
          <form action="{{ route('admin_profel_update_password') }}" method="post">
            @csrf 
            <label for="current_password">Joriy parol</label>
            <input type="password" name="current_password" class="form-control mb-2" required>
            <label for="new_password">Yangi parol</label>
            <input type="password" name="new_password" class="form-control mb-2" required>
            <label for="new_password_confirmation">Yangi parolni takrorlang</label>
            <input type="password" name="new_password_confirmation" class="form-control mb-2" required>
            <button class="btn btn-primary w-100" type="submit">Parolni yangilash</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</section>

</main>
@endsection