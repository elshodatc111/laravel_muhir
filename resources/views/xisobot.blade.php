@extends('layouts.layout')

@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Tarqatilgan muxirlar</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Muxirlar</a></li>
      <li class="breadcrumb-item active">Tarqatilgan muxirlar</li>
    </ol>
  </nav>
</div>
  <div class="w-100 text-center"><button class="btn btn-primary" id="downloadExcel"><i class="bi bi-printer"></i> Print Excel</button></div>
  <table class="table text-center table-striped table-bordered" id="myTable">
    <thead>
      <tr>
        <th class="bg-primary text-white text-center">#</th>
        <th class="bg-primary text-white text-center">Muxir raqami</th>
        <th class="bg-primary text-white text-center">Omborga keldi</th>
        <th class="bg-primary text-white text-center">Tasdiqlagan operator</th>
        <th class="bg-primary text-white text-center">Faktura raqam</th>
        <th class="bg-primary text-white text-center">Bo'lim kodi</th>
        <th class="bg-primary text-white text-center">Bo'lim</th>
        <th class="bg-primary text-white text-center">Muxirchi</th>
        <th class="bg-primary text-white text-center">Operator</th>
        <th class="bg-primary text-white text-center">Tarqatildi</th>
        <th class="bg-primary text-white text-center">Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($tarqatildi as $item)
        <tr>
          <td>{{ $loop->index+1 }}</td>
          <td>{{ $item['number'] }}</td>
          <td>{{ $item['omborda'] }}</td>
          <td>{{ $item['omborda_operator'] }}</td>
          <td>{{ $item['faktura'] }}</td>
          <td>{{ $item['bolim_kod'] }}</td>
          <td>{{ $item['bolim'] }}</td>
          <td>{{ $item['muxirchi'] }}</td>
          <td>{{ $item['operator'] }}</td>
          <td>{{ $item['data'] }}</td>
          <td>
            @if($item['scanner']=='upload')
              Tasdiqlandi
            @else
              Tasdiqlanish kutilmoqda
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>
    <!-- Jadvaldan Excel yaratish scripti -->
    <script>
        document.getElementById('downloadExcel').addEventListener('click', function() {
            var table = document.getElementById('myTable');
            var workbook = XLSX.utils.table_to_book(table, {sheet: "Sheet1"});
            XLSX.writeFile(workbook, 'jadval.xlsx');
        });
    </script>
@endsection
