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
  <div class="col-3"><a href="{{ route('naryad_blanka') }}" class="btn btn-secondary w-100">Mavjud naryad (blanka)</a></div>
  <div class="col-3"><a href="{{ ROUTE('naryad_blanka_korzinka') }}" class="btn btn-primary w-100">Korzinka naryad (blanka)</a></div>
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
  <div class="row">
    <div class="col-6">
      <div class="card recent-sales overflow-auto">
        <h4 class="card-title w-100 text-center">Tarqatish uchun yig'ilgan naryad blankalar</h4>
        <div class="card-body">   
          <table class="table text-center table-striped table-bordered">
            <thead>
              <tr>
                <th class="bg-primary text-white text-center">#</th>
                <th class="bg-primary text-white text-center">Naryad blanka raqami</th>
                <th class="bg-primary text-white text-center">Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($Muxir as $item)
                <tr>
                  <td>{{ $loop->index+1 }}</td>
                  <td>{{ $item['number'] }}</td>
                  <td>
                    <form action="{{ route('naryad_blanka_korzinka_delete') }}" method="post">
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
            <form action="{{ route('naryad_blanka_korzinka_delete_all') }}" method="post">
              @csrf 
              <button class="btn btn-danger">Yig'ilganlarni barchasini o'chirish</button>
            </form>
          </div>
          @endif 
        </div>
      </div>
    </div>

   <script>
      function showUser(str) {
        if (str == "") {
          document.getElementById("txtHint").innerHTML = "";
          return;
        } else {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("txtHint").innerHTML = this.responseText;
            }
          };
          xmlhttp.open("GET","korzinka/bolim/"+str,true);
          xmlhttp.send();
        }
      }
    </script>
    <div class="col-6">
      <div class="card recent-sales overflow-auto">
        <h4 class="card-title w-100 text-center">Qabul qiluvchi haqidagi ma`lumot</h4>
        <div class="card-body">   
          <form action="{{ route('muxir_faktura_pdf') }}" method="post">
            @csrf 
            <input type="hidden" name="count" value="{{$count}}">
            <label for="">Qabul qiluvchi bo'lim</label>
            <select name="coato" onchange="showUser(this.value)" required class="form-select my-2">
              <option value="_">Tanlang...</option> 
              @foreach($Bolim as $item)
                <option value="{{ $item['coato'] }}">{{ $item['name'] }}</option>
              @endforeach
            </select>
            <div id="txtHint">
              <label for="hodim" class="my-2">Bo'limdagi masul shaxs</label>
              <select name="hodim" class="form-select" required>
                <option value="">Tanlang...</option>
              </select>
            </div>
            @if($count!=0)
            <br>
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
