@extends('layouts.layout')
@section('title',"Muhir hisob varaqlar")
@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Muhir hisob varaqlar</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active">Muhir hisob varaqlar</li>
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
<div class="row mb-3">
  <div class="col-3"><a href="{{ route('arxiv_muxir') }}" class="btn btn-primary w-100">Muxirlar</a></div>
  <div class="col-3"><a href="{{ route('arxiv_naryad_blanka') }}" class="btn btn-secondary w-100">Naryad(blankalar)</a></div>
  <div class="col-3"><a href="{{ route('arxiv_naryadlar') }}" class="btn btn-secondary w-100">Naryadlar</a></div>
  <div class="col-3"><a href="{{ route('arxiv_simkarta') }}" class="btn btn-secondary w-100">Sim kartalar</a></div>
</div>
<section class="section dashboard">
  <div class="card recent-sales overflow-auto pt-3">
    <div class="card-body">   
      <table class="table text-center table-striped table-bordered datatable">
        <thead>
          <tr>
            <th class="bg-primary text-white text-center">#</th>
            <th class="bg-primary text-white text-center">Hisob varaq raqami</th>
            <th class="bg-primary text-white text-center">Qabul qilgan bo'lim</th>
            <th class="bg-primary text-white text-center">Qabul qilgan hodim</th>
            <th class="bg-primary text-white text-center">Muxirlar soni</th>
            <th class="bg-primary text-white text-center">Operator</th>
            <th class="bg-primary text-white text-center">Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($Faktura as $item)
          <tr>
            <td>{{ $loop->index+1 }}</td>
            <td><a href="{{ route('muxir_faktura_show',$item['number'] ) }}">{{ $item['number'] }}</a></td>
            <td>{{ $item['coato_name'] }}</td>
            <td>{{ $item['hodim'] }}</td>
            <td>{{ $item['count'] }} dona</td>
            <td>{{ $item['operator'] }}</td>
            <td>
              @if($item['status']=='Tasdiqlangan')  
                <b class="text-success">Tasdiqlangan</b>
              @else 
                <b class="text-danger">Tasdiqlanmagan</b>
              @endif
          </td>
          </tr>
          @empty

          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</section>

</main>
@endsection
