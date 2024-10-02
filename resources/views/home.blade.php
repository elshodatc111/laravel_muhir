@extends('layouts.layout')

@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Muhirlar</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Muhir</a></li>
      <li class="breadcrumb-item active">Mavjud muxirlar</li>
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
          <h5 class="card-title">Mavjud Muxirlar</h5>
        </div>
        <div class="col-6" style="text-align:right">
          <a href="{{ route('home_create') }}" class="btn btn-primary mt-3">Yangi Muxir</a>
        </div>
      </div>
      <table class="table text-center table-striped table-bordered datatable">
        <thead>
          <tr>
            <th class="bg-primary text-white text-center">#</th>
            <th class="bg-primary text-white text-center">Muxir raqami</th>
            <th class="bg-primary text-white text-center">Ro'yhatga olindi</th>
            <th class="bg-primary text-white text-center">Operator</th>
            <th class="bg-primary text-white text-center">Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($Muxir as $item)
          <tr>
            <th scope="row">{{ $loop->index+1 }}</th>
            <td>{{ $item['number'] }}</td>
            <td>{{ $item['created_at'] }}</td>
            <td>{{ $item['operator'] }}</td>
            <td>
              <form action="{{ route('home_story_pedding') }}" method="post">
                @csrf 
                <input type="hidden" name="id" value="{{ $item['id'] }}">
                <button class="btn btn-primary p-0 m-0 px-1"><i class="bi bi-plus"></i></button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5">Muxirlar mavjud emas.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</section>

</main>
@endsection
