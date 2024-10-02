@extends('layouts.layout')

@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Hisob varaqalar</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active">Hisob varaqalar</li>
    </ol>
  </nav>
</div>
<div class="card">
  <div class="card-body pt-3">
    <ul class="nav nav-tabs nav-tabs-bordered d-flex">
      <li class="nav-item flex-fill bg-primary text-white" role="presentation">
        <a href="{{ route('faktura') }}" class="nav-link w-100 text-center bg-primary text-white">Faktura Muxirlar</a>
      </li>
      <li class="nav-item flex-fill bg-secondary text-white" role="presentation">
        <a href="#" class="nav-link w-100 text-center bg-secondary text-white">Faktura Naryadlar</a>
      </li>
    </ul>
  </div>
</div>
<section class="section dashboard">
  <div class="card recent-sales overflow-auto">
    <div class="card-body pt-3">
      <table class="table text-center table-striped table-bordered datatable">
        <thead>
          <tr>
            <th class="bg-primary text-white text-center">#</th>
            <th class="bg-primary text-white text-center">Faktura raqami</th>
            <th class="bg-primary text-white text-center">Bo'lim kodi</th>
            <th class="bg-primary text-white text-center">Muhir soni</th>
            <th class="bg-primary text-white text-center">Muxirchi</th>
            <th class="bg-primary text-white text-center">Operator</th>
            <th class="bg-primary text-white text-center">Status</th>
            <th class="bg-primary text-white text-center">Berilgan vaqt</th>
          </tr>
        </thead>
        <tbody>
          @forelse($Korzinka as $item)
          <tr>
            <td>{{ $loop->index+1 }}</td>
            <th scope="row"><a href="{{ route('faktura_show', $item['id']) }}">{{ $item['number'] }}</a></th>
            <td>{{ $item['coato'] }}</td>
            <td>{{ $item['count'] }}</td>
            <td>{{ $item['fio'] }}</td>
            <td>{{ $item['opertor'] }}</td>
            <td>
              @if($item['scanner']=='new')
                <b class="p-1 m-0 bg-danger text-white">Tasdiqlanmagan</b>
              @else 
                <b class="p-1 m-0 bg-success text-white">Tasdiqlandi</b>
              @endif
            </td>
            <td>{{ $item['updated_at'] }}</td>
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
