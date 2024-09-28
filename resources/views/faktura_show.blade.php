@extends('layouts.layout2')

@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Hisob varaq</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('faktura') }}">Hisob varaqalar</a></li>
      <li class="breadcrumb-item active">Hisob varaq</li>
    </ol>
  </nav>
</div>

<section class="section dashboard">
  <div class=" print-section border"style="font-size:10">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title w-100 text-center">Xisob Faktura № {{ $faktura['number'] }}</h4>
        <table class="table table-bordered text-center">
          <tr>
            <th>"TAMINOTCHI"</th>
            <th>"QABUL QILUVCHI"</th>
          </tr>
          <tr>
            <td>Energo savdo MCHJ</td>
            <td>{{ $faktura['bolim'] }}</td>
          </tr>
        </table>
        <h6 class="w-100 text-center">Muxirlar soni: {{ $faktura['count'] }}(dona)</h6>
        <hr>
            <table class="table table-bordered text-center">
              <tr>
                @if($faktura['count']==1)
                <th>Muhir raqami</th>
                @elseif($faktura['count']==2)
                <th>Muhir raqami</th>
                <th>Muhir raqami</th>
                @elseif($faktura['count']==3)
                <th>Muhir raqami</th>
                <th>Muhir raqami</th>
                <th>Muhir raqami</th>
                @elseif($faktura['count']==4)
                <th>Muhir raqami</th>
                <th>Muhir raqami</th>
                <th>Muhir raqami</th>
                <th>Muhir raqami</th>
                @else 
                <th>Muhir raqami</th>
                <th>Muhir raqami</th>
                <th>Muhir raqami</th>
                <th>Muhir raqami</th>
                <th>Muhir raqami</th>
                @endif
              </tr>
              @foreach($faktura['muxir'] as $item)
              <tr>
                @foreach($item as $value)
                <td>{{ $value }}</td>
                @endforeach
              </tr>
              @endforeach
            </table>
        <hr>
        <div class="row text-center">
          <div class="col-6">
            <b class="p-0 m-0">Bo'lim nomi va raxbari bo'lim raxbari </b>
            <p class="p-0 m-0">__________________ Muzrob Karimov </p>
            <b class="p-0 m-0">Berib yubordi: </b>
            <p class="p-0 m-0">__________________ {{ $faktura['opertor'] }} </p>
          </div>
          <div class="col-6">
            <b class="p-0 m-0">{{ $faktura['bolim'] }} </b>
            <p class="p-0 m-0">Oldim:  ____________ {{ $faktura['fio'] }} </p>
            <b class="p-0 m-0">Sana: </b>
            <p class="p-0 m-0">{{ $faktura['created_at'] }}</p>
          </div>
          <div class="col-12">
            <hr>
            <div class="container">
              Lorem ipsum dolor sit amet consectetur, adipisicing elit. Itaque nisi consequatur hic cumque delectus odit voluptas fuga ipsam, laborum maxime nihil nobis blanditiis. Earum sint nostrum, autem ratione inventore hic.
            </div>
            ___________
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="w-100 text-center">
    <button id="printButton" class="btn btn-primary mb-3"><i class="bi bi-printer"></i> Pechat</button>
  </div>
  @if($faktura['scanner']=='new')
  <div class="card">
    <div class="card-body">
      <h4 class="card-title w-100 text-center">Tasdiqlangan hisob faktura</h4>
      <form action="{{ route('faktura_image') }}" method="post" class="text-center" enctype="multipart/form-data">
        @csrf 
        <input type="hidden" name="id" value="{{ $faktura['id'] }}">
        <label for="scanner">Scanner nusxasi (jpg,png)</label>
        <input type="file" required name="scanner" class="form-control mt-3">
        <button type="submit" class="btn btn-primary w-50 mt-3">Saqlash</button>
      </form>
    </div>
  </div>
  @else
  <div class="card">
    <div class="card-body">
      <h4 class="card-title w-100 text-center">Tasdiqlangan hisob faktura</h4>
      <img src="../../images/{{ $faktura['scanner_url'] }}" class="w-100">
    </div>
  </div>
  @endif 
</section>

</main>
@endsection
