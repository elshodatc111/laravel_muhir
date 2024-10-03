@extends('layouts.layout')
@section('title',"Home")
@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Administrator</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active">Barcha foydalanuvchilar</li>
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
      <div class="w-100" style="text-align:right">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#verticalycentered">Yangi Foydalanuvchi</button>
      </div>
      <table class="table text-center table-striped table-bordered">
        <thead>
          <tr>
            <th class="bg-primary text-white text-center">#</th>
            <th class="bg-primary text-white text-center">FIO</th>
            <th class="bg-primary text-white text-center">Email</th>
            <th class="bg-primary text-white text-center">Role</th>
            <th class="bg-primary text-white text-center">Yangilandi</th>
            <th class="bg-primary text-white text-center">Ro'yhatga olindi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($User as $item)
          <tr>
            <td>{{ $loop->index+1 }}</td>
            <td><a href="{{ route('admin_user_show',$item['id']) }}">{{ $item['name'] }}</a></td>
            <td>{{ $item['email'] }}</td>
            <td>
              @if($item['role']==1)
                Adminsitrator 
              @elseif($item['role']==2)
                Admin 
              @elseif($item['role']==3)
                Meneger
              @else
                Operator 
              @endif 
            </td>
            <td>{{ $item['updated_at'] }}</td>
            <td>{{ $item['created_at'] }}</td>
          </tr>
          @empty
            <tr>
              <td class="text-center" colspan=6>Administratorlar mavjud emas.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</section>

</main>



  <div class="modal fade" id="verticalycentered" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Yangi foydalanuvchi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin_create') }}" method="post">
            @csrf 
            <label for="name" class="mb-2">Foydalanuvchi FIO</label>
            <input type="text" name="name" class="form-control" required>
            <label for="email" class="my-2">Foydalanuvchi Email</label>
            <input type="email" name="email" class="form-control" required>
            <label for="role" class="my-2">Foydalanuvchi Role</label>
            <select name="role" class="form-select mb-3">
              <option value="">Tanlang...</option>
              <option value="1">Administrator</option>
              <option value="2">Admin</option>
              <option value="3">Meneger</option>
              <option value="4">Operator</option>
            </select>
            <button class="btn btn-primary w-100" type="submit">Saqlash</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
