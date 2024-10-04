@extends('layouts.layout')
@section('title',"Korzinka")
@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Muhirlar</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active">Korzinka muxirlar</li>
    </ol>
  </nav>
</div>
<div class="row mb-3">
  <div class="col-3"><a href="{{ route('muxir') }}" class="btn btn-secondary w-100">Mavjud muxirlar</a></div>
  <div class="col-3"><a href="{{ route('muxir_korzinka') }}" class="btn btn-primary w-100">Korzinka muxirlar</a></div>
  <div class="col-3"><a href="{{ route('muxir_new') }}" class="btn btn-secondary w-100">Yangi muxir</a></div>
  <div class="col-3"><a href="{{ route('muxir_new_two') }}" class="btn btn-secondary w-100">Yangi muxir 2</a></div>
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
    <div class="col-6">
      <div class="card recent-sales overflow-auto">
        <h4 class="card-title w-100 text-center">Tarqatish uchun yig'ilgan muxirlar</h4>
        <div class="card-body">   
          <table class="table text-center table-striped table-bordered">
            <thead>
              <tr>
                <th class="bg-primary text-white text-center">#</th>
                <th class="bg-primary text-white text-center">Muxir raqami</th>
                <th class="bg-primary text-white text-center">Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($Muxir as $item)
                <tr>
                  <td>{{ $loop->index+1 }}</td>
                  <td>{{ $item['number'] }}</td>
                  <td>
                    <form action="{{ route('muxir_korzinka_muxir_del') }}" method="post">
                      @csrf 
                      <input type="hidden" name="id" value="{{ $item['id'] }}">
                      <button class="btn btn-danger p-0 px-1"><i class="bi bi-trash"></i></button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td class="text-center" colspan=3>Tarqatish uchun muxirlar mavjud emas.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
          @if($count!=0)
          <div class="w-100 text-center">
            <form action="{{ route('muxir_korzinka_muxir_del_all') }}" method="post">
              @csrf 
              <button class="btn btn-danger">Yig'ilganlarni barchasini o'chirish</button>
            </form>
          </div>
          @endif 
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card recent-sales overflow-auto">
        <h4 class="card-title w-100 text-center">Qabul qiluvchi haqidagi ma`lumot</h4>
        <div class="card-body">   
          <form action="" method="post">
            <label for="">Qabul qiluvchi bo'lim</label>
            <select name="" required class="form-select my-2">
              <option value="">Tanlang...</option>
            </select>
            <label for="">Qabul qiluvchi hodim</label>
            <select name="" required class="form-select my-2">
              <option value="">Tanlang...</option>
            </select>
            @if($count!=0)
            <button class="btn btn-primary w-100">Tasdiqlash</button>
            @endif
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

</main>
@endsection
