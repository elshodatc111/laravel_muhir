@extends('layouts.layout2')
@section('title',"Bo'limlar")
@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Bo'lim</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('bolim') }}">Barcha bo'limlar</a></li>
      <li class="breadcrumb-item active">Bo'lim</li>
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
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body text-center">   
          <h4 class="w-100 text-center card-title">Yangi majburiyotnomani saqlash</h4>
          <form action="{{ route('bolim_show_pdf_upload') }}" method="post" enctype="multipart/form-data">
            @csrf 
            <input type="hidden" name="coato" value="{{ $Bolim['coato'] }}">
            <label for="file" class="mb-2">Yangi majburiyatnoma</label>
            <input type="file" name="file" class="form-control mb-2" required >
            <button type="submit" class="btn btn-primary w-50">Saqlash</button>
          </form>
        </div>
      </div>
    </div>
    @foreach($BolimPDF as $item)
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">   
          <iframe src="../majburiyatnoma/{{ $item['url'] }}" width="100%" height="600px">
              PDF faylni ko'rsatish imkoni bo'lmagan holda shu matnni ko'rsating.
          </iframe>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  

</section>

</main>
@endsection
