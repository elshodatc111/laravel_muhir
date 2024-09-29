@extends('layouts.layout')

@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Hodimlar</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active">Barcha hodimlar</li>
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
    <div class="card-body pt-3">
      <table class="table text-center table-striped table-bordered datatable">
        <thead>
          <tr>
            <th class="bg-primary text-white text-center">#</th>
            <th class="bg-primary text-white text-center">FIO</th>
            <th class="bg-primary text-white text-center">Login</th>
            <th class="bg-primary text-white text-center">Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach($User as $item)
          <tr>
            <td>{{ $loop->index+1 }}</td>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['email'] }}</td>
            <td>
              <form action="{{ route('HodimlarDelete') }}" method="post" style="display:inline">
                @csrf 
                <input type="hidden" name="id" value="{{ $item['id'] }}">
                <button class="btn btn-danger p-0 m-0 px-1"><i class="bi bi-trash"></i></button>
              </form>
              <form action="{{ route('HodimRessetPassword') }}" method="post" style="display:inline">
                @csrf 
                <input type="hidden" name="id" value="{{ $item['id'] }}">
                <button class="btn btn-warning text-white p-0 m-0 px-1"><i class="bi bi-arrow-clockwise"></i></button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="card recent-sales overflow-auto">
    <div class="card-body">
      <div class="h4 card-title w-100 text-center">Yangi hodim qo'shish</div>
      <form action="{{ route('HodimlarCreate') }}" method="post">
        @csrf 
        <label for="name" class="my-2">FIO</label>
        <input type="text" name="name" required  class="form-control">
        <label for="email" class="my-2">Email</label>
        <input type="email" name="email" required  class="form-control">
        <button class="btn btn-primary mt-4" type="submit">Saqlash</button>
      </form>
    </div>
  </div>
</section>

</main>
@endsection
