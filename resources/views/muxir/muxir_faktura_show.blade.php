@extends('layouts.layout2')
@section('title',"Muhir hisob varaq")
@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Muhir hisob varaq</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('arxiv_muxir') }}">Arxiv muhir hisob varaqlar</a></li>
      <li class="breadcrumb-item active">Muhir hisob varaq</li>
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
    <div class="col-6">
      <div class="card recent-sales overflow-auto print-section" style="font-size:14px;">
        <div class="card-body">   
          <P class="card-title w-100 text-center">HISOB VARAQ FAKTURA № {{ $MuxirFaktura['number'] }}</P>
          <table class="table table-bordered text-center">
            <tr>
              <td><b>"TAMINOTCHI"</b></td>
              <td><b>"QABUL QILUVCHI"</b></td>
            </tr>
            <tr>
              <td>QASHQADARYO ENERGO SAVDO</td>
              <td>{{ $MuxirFaktura['coato_name'] }}</td>
            </tr>
          </table>
          <table class="table table-bordered text-center">
            <tr>
              @if($MuxirFaktura['count']==1)
              <th>Muhir raqami</th>
              @elseif($MuxirFaktura['count']==2)
              <th>Muhir raqami</th>
              <th>Muhir raqami</th>
              @elseif($MuxirFaktura['count']==3)
              <th>Muhir raqami</th>
              <th>Muhir raqami</th>
              <th>Muhir raqami</th>
              @elseif($MuxirFaktura['count']==4)
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
            @foreach($Muxirs as $item)
            <tr>
              @foreach($item as $value)
              <td>{{ $value }}</td>
              @endforeach
            </tr>
            @endforeach
          </table>
          <table class="table table-bordered text-center">
            <tr>
              <td><b>JAMI MUXIR SONI:</b></td>
              <td><b>{{ $MuxirFaktura['count'] }} (dona)</b></td>
            </tr>
          </table>
          <div class="row text-center">
            <div class="col-6">
              <b>EEXO va HQAT tadbiq qilish sektori boshlig'i</b>
              <p>___________ Karimov Muzrob</p>
              <b>Berib yubordim</b>
              <p>___________ {{ $MuxirFaktura['operator'] }}</p>
            </div>
            <div class="col-6">
              <b>{{ $MuxirFaktura['coato_name'] }}</b>
              <p>___________ {{ $Hodim['name'] }}</p>
              <b>Berib yuborilgan vaqt</b>
              <p>{{ $MuxirFaktura['created_at'] }}</p>
            </div>
            <div class="col-12">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa animi rerum amet perferendis, mollitia deleniti beatae porro magnam expedita quaerat iusto, odio dolorem aperiam unde repellat voluptatem voluptate quos neque.</div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card">
        <div class="card-body">
          @if($MuxirFaktura['scanner']=='false')
            <h4 class="card-title w-100 text-center">Hisob varaq tasdiqlangan (PDF) faylni yuklang</h4>
            <form action="{{ route('faktura_upload_muxir') }}" method="post"  enctype="multipart/form-data">
              @csrf 
              <input type="hidden" name="number" value="{{ $MuxirFaktura['number'] }}">
              <div class="row">
                <div class="col-6">
                  <input type="file" name="scanner" required class="form-control">
                </div>
                <div class="col-6">
                  <button class="btn btn-primary w-100">Saqlash</button>
                </div>
              </div>
            </form>
          @else 
            <h4 class="card-title w-100 text-center">Hisob varaq tasdiqlangan (PDF) nushasi</h4>
            <iframe src="../muxir/{{ $MuxirFaktura['scanner_url'] }}" width="100%" height="600px">
                PDF faylni ko'rsatish imkoni bo'lmagan holda shu matnni ko'rsating.
            </iframe>
            @if(auth()->user()->role==1)
              <form action="{{ route('faktura_delete_faktura') }}" method="post">
                @csrf 
                <input type="hidden" name="number" value="{{ $MuxirFaktura['number'] }}">
                <div class="w-100 text-center mt-3">
                <button class="btn btn-danger w-50"><i class="bi bi-trash"> Hisob fakturani o'chirish</i></button>
                </div>
              </form>
            @endif
          @endif

        </div>
      </div>
    </div>
</div>
  <div class="w-100 text-center">
    <button id="printButton" class="btn btn-primary mb-3"><i class="bi bi-printer"></i> HISOB VARAQ FAKTURA PECHAT</button>
  </div>
  @if(auth()->user()->role==1)
    <form action="{{ route('faktura_delete_faktura') }}" method="post">
      @csrf 
      <input type="hidden" name="number" value="{{ $MuxirFaktura['number'] }}">
      <div class="w-100 text-center mt-3">
      <button class="btn btn-warning text-white w-50"><i class="bi bi-trash"> Hisob fakturani o'chirish</i></button>
      </div>
    </form>
  @endif
</section>

</main>
<script>
  document.getElementById('printButton').addEventListener('click', function() {
    var printContents = document.querySelector('.print-section').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
  });
</script>
@endsection
