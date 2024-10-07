@extends('layouts.layout')
@section('title',"naryad (blanka)")
@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Naryad blanka</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active">Naryad (blanka)</li>
    </ol>
  </nav>
</div>
<div class="row mb-3">
  <div class="col-3"><a href="{{ route('naryad_blanka') }}" class="btn btn-primary w-100">Mavjud naryad (blanka)</a></div>
  <div class="col-3"><a href="{{ ROUTE('naryad_blanka_korzinka') }}" class="btn btn-secondary w-100">Korzinka naryad (blanka)</a></div>
  <div class="col-3"><a href="{{ ROUTE('naryad_blanka_NEW') }}" class="btn btn-secondary w-100">Yangi naryad (blanka)</a></div>
  <div class="col-3"><a href="{{ ROUTE('naryad_blanka_NEW_TWO') }}" class="btn btn-secondary w-100">Yangi naryad (blanka) 2</a></div>
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
      <input type="text" id="searchInput" class="form-control mb-3" placeholder="Qidiruv...">
      <table class="table text-center table-striped table-bordered" id="muxirTable">
        <thead>
          <tr>
            <th class="bg-primary text-white text-center">Naryad(blanka) raqami</th>
            <th class="bg-primary text-white text-center">Ro'yhatga olindi</th>
            <th class="bg-primary text-white text-center">Operator</th>
            <th class="bg-primary text-white text-center">Status</th>
          </tr>
        </thead>
        <tbody>
        @forelse($NaryadB as $item)
          <tr>
            <td>{{ $item['number'] }}</td>
            <td>{{ $item['created_at'] }}</td>
            <td>{{ $item['meneger'] }}</td>
            <td>
              <form action="{{ route('naryad_blanka_korzinka_add') }}" method="post" style="display:inline">
              @csrf 
                <input type="hidden" name="id" value="{{ $item['id'] }}">
                <button type="submit" class="btn btn-primary p-0 px-1"><i class="bi bi-plus"></i></button>
              </form>
              @if(auth()->user()->role==1)
              <form action="{{ route('naryad_blanka_delete') }}" method="post" style="display:inline">
                @csrf 
                <input type="hidden" name="id" value="{{ $item['id'] }}">
                <button type="submit" class="btn btn-danger p-0 px-1"><i class="bi bi-trash"></i></button>
              </form>
              @endif 
            </td>
          </tr>
          @empty
          <tr>
            <td colspan=4 class="text-center">Naryad blankalar mavjud emas</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</section>

</main>

<script>
  document.getElementById('searchInput').addEventListener('keyup', function() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById('searchInput');
    filter = input.value.toLowerCase();
    table = document.getElementById('muxirTable');
    tr = table.getElementsByTagName('tr');
    
    for (i = 1; i < tr.length; i++) { // start from 1 to skip the header row
      tr[i].style.display = 'none'; // hide rows by default
      
      td = tr[i].getElementsByTagName('td');
      for (j = 0; j < td.length; j++) {
        if (td[j]) {
          txtValue = td[j].textContent || td[j].innerText;
          if (txtValue.toLowerCase().indexOf(filter) > -1) {
            tr[i].style.display = ''; // show row if a match is found
            break; // stop searching other columns
          }
        }
      }
    }
  });
</script>

@endsection
