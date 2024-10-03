@extends('layouts.layout2')
@section('title',"Home")
@section('content')
  <main id="main" class="main">

  <div class="pagetitle">
    <h1>Administrator</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin_user') }}">Barcha foydalanuvchilar</a></li>
        <li class="breadcrumb-item active">Foydalanuvchi</li>
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
        <div class="card recent-sales overflow-auto">
          <div class="card-body pt-4">   
            <form action="{{ route('admin_update') }}" method="post">
              @csrf 
              <input type="hidden" name="id" value="{{ $User['id'] }}">
              <label for="name" class="mb-2">Foydalanuvchi FIO</label>
              <input type="text" name="name" value="{{ $User['name'] }}" class="form-control" required>
              <label for="email" class="my-2">Foydalanuvchi Email</label>
              <input type="email" name="email"value="{{ $User['email'] }}"  class="form-control" disabled required>
              <label for="role" class="my-2">Foydalanuvchi Role</label>
              <select name="role" class="form-select mb-3">
                <option value="">Tanlang...</option>
                <option value="1">Administrator</option>
                <option value="2">Admin</option>
                <option value="3">Meneger</option>
                <option value="4">Operator</option>
              </select>
              <button class="btn btn-primary w-100 mt-2" type="submit">O'zgarishlarni saqlash</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card recent-sales overflow-auto">
          <div class="card-body pt-4">   
            <form action="{{ route('admin_update_password') }}" method="post">
              @csrf 
              <input type="hidden" name="id" value="{{ $User['id'] }}">
              <label for="password" class="mb-2">Yangi parol kiriting</label>
              <input type="password" name="password" class="form-control" required>
              <button class="btn btn-primary w-100 mt-2" type="submit">Parolni yangilash</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  </main>

@endsection
