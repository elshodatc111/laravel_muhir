@extends('layouts.layout')

@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Faktura</a></li>
      <li class="breadcrumb-item active">Mavjud muxirlar</li>
    </ol>
  </nav>
</div>

<section class="section dashboard">
  <div class="card recent-sales overflow-auto">
    <div class="card-body">
      <div class="row">
        <div class="col-6">
          <h5 class="card-title">Mavjud muxirlar</h5>
        </div>
        <div class="col-6" style="text-align:right">
          <a href="#" class="btn btn-primary mt-3">Yangi Muxir</a>
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
          <tr>
            <th scope="row"><a href="#">#</a></th>
            <td>745845</td>
            <td>2024-04-05 15:14:59</td>
            <td>Elshod Musurmonov</td>
            <td>
              <form action="" method="post">
                @csrf 
                <button class="btn btn-primary p-0 m-0 px-1"><i class="bi bi-plus"></i></button>
              </form>
            </td>
          </tr>
          <tr>
            <th scope="row"><a href="#">#</a></th>
            <td>745845</td>
            <td>2024-04-05 15:14:59</td>
            <td>Elshod Musurmonov</td>
            <td>
              <form action="" method="post">
                @csrf 
                <button class="btn btn-primary p-0 m-0 px-1"><i class="bi bi-plus"></i></button>
              </form>
            </td>
          </tr>
          <tr>
            <th scope="row"><a href="#">#</a></th>
            <td>745845</td>
            <td>2024-04-05 15:14:59</td>
            <td>Elshod Musurmonov</td>
            <td>
              <form action="" method="post">
                @csrf 
                <button class="btn btn-primary p-0 m-0 px-1"><i class="bi bi-plus"></i></button>
              </form>
            </td>
          </tr>
          <tr>
            <td colspan="5">Muxirlar mavjud emas.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

</main>
@endsection
