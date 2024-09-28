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
  <div class="row">
    <div class="col-lg-6">
      <div class="card recent-sales overflow-auto">
        <div class="card-body">
          <h5 class="card-title w-100 text-center">Yig'ilgan muxirlar ({{ $count }} dona)</h5>
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
                <th scope="row">{{ $loop->index+1 }}</th>
                <td>{{ $item['number'] }}</td>
                <td>
                  <form action="{{ route('korzinka_delete') }}" method="post">
                    @csrf 
                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                    <button class="btn btn-danger p-0 m-0 px-1"><i class="bi bi-trash"></i></button>
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
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title w-100 text-center">Muxir qaysi bo'limga berilmoqda</h4>
          <form action="{{ route('korzinka_faktura') }}" method="post">
            @csrf 
            <input type="hidden" name="count" value="{{ $count }}">
            <label for="" class="mb-2">Bo'limni tanlang</label>
            <select name="coato" class="form-select" required onchange="showUser(this.value)">
              <option value="coato">Tanlang...</option>
              @foreach($Bolim as $item)
                <option value="{{ $item['coato'] }}">{{ $item['name'] }}</option>
              @endforeach
            </select>
            <div id="txtHint">
              <label for="fio" class="my-2">Bo'limdagi masul shaxs</label>
              <select name="fio" class="form-select" required>
                <option value="">Tanlang...</option>
              </select>
            </div>
            <button class="btn btn-primary w-100 mt-3">Tasdiqlash</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

</main>
@endsection
