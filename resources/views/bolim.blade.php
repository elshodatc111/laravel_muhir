@extends('layouts.layout')

@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Bo'limlar</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active">Bo'limlar</li>
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
        <div class="col-6">
          <h5 class="card-title"></h5>
        </div>
        <div class="col-6" style="text-align:right">
          <a href="{{ route('create_bolim') }}" class="btn btn-primary mt-3">Yangi bo'lim</a>
        </div>
      </div>
      <table class="table text-center table-striped table-bordered datatable">
        <thead>
          <tr>
            <th class="bg-primary text-white text-center">#</th>
            <th class="bg-primary text-white text-center">Bo'lim kodi</th>
            <th class="bg-primary text-white text-center">Bo'lim nomi</th>
            <th class="bg-primary text-white text-center">Hodimlar soni</th>
            <th class="bg-primary text-white text-center">Bo'lim xolati</th>
          </tr>
        </thead>
        <tbody>
          @forelse($Bolim as $item)
          <tr>
            <th scope="row">{{ $loop->index+1 }}</th>
            <td><a href="{{ route('bolim_show',$item['id']) }}">{{ $item['coato'] }}</a></td>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['count'] }}</td>
            <td>
              @if($item['status']=='true')
                Activ 
              @else 
                Bloklangan
              @endif 
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5">Bo'limlar mavjud emas.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</section>

</main>
@endsection
