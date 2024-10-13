@extends('layouts.layout')
@section('title',"Naryad")
@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Naryadlar</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active">Mavjud Naryadlar</li>
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
      <div style="text-align:right">
        <a href="{{ route('naryad_create') }}" class="btn btn-success"><i class="bi bi-plus">Yangi naryad</i></a>
      </div>
      <table class="table text-center table-striped table-bordered datatable">
        <thead>
          <tr>
            <th class="bg-primary text-white text-center">#</th>
            <th class="bg-primary text-white text-center">Tuman(Shaxar)</th>
            <th class="bg-primary text-white text-center">Naryad raqami</th>
            <th class="bg-primary text-white text-center">Naryad turi</th>
            <th class="bg-primary text-white text-center">Istemolchi turi</th>
            <th class="bg-primary text-white text-center">Hisob raqam</th>
            <th class="bg-primary text-white text-center">Eski Hisoblagich</th>
            <th class="bg-primary text-white text-center">Yangi Hisoblagich</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>sss</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        
        </tbody>
      </table>
    </div>
  </div>
</section>

</main>
@endsection
