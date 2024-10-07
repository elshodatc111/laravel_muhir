@extends('layouts.layout2')
@section('title',"Naryad blanka")
@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Muhir hisob varaq</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('arxiv_naryad_blanka') }}">Naryad blankalari</a></li>
      <li class="breadcrumb-item active">Naryad blanka</li>
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
      <div class="card recent-sales overflow-auto print-section" style="font-size:10px;">
        <div class="card-body">   
          <P class="card-title w-100 text-center">HISOB VARAQ FAKTURA № {{ $MuxirFaktura['number'] }}</P>
          <table class="table table-bordered text-center">
            <tr>
              <td><b>"TAMINOTCHI"</b></td>
              <td><b>"QABUL QILUVCHI"</b></td>
            </tr>
            <tr>
              <td style="width:50%;">"HET" AJ "ENERGOSAVDO FILIALI QASHQADARYO BO'LINMASI</td>
              <td style="width:50%;">{{ $MuxirFaktura['coato_name'] }}</td>
            </tr>
          </table>
          <table class="table table-bordered text-center p-0 m-0">
            <tr>
              @if($MuxirFaktura['count']==1)
              <th>Naryad raqam</th>
              @elseif($MuxirFaktura['count']==2)
              <th>Naryad raqam</th>
              <th>Naryad raqam</th>
              @elseif($MuxirFaktura['count']==3)
              <th>Naryad raqam</th>
              <th>Naryad raqam</th>
              <th>Naryad raqam</th>
              @elseif($MuxirFaktura['count']==4)
              <th>Naryad raqam</th>
              <th>Naryad raqam</th>
              <th>Naryad raqam</th>
              <th>Naryad raqam</th>
              @else 
              <th>Naryad raqam</th>
              <th>Naryad raqam</th>
              <th>Naryad raqam</th>
              <th>Naryad raqam</th>
              <th>Naryad raqam</th>
              @endif
            </tr>
            @foreach($Muxirs as $item)
            <tr>
              @foreach($item as $value)
              <td class="m-0 p-0">{{ $value }}</td>
              @endforeach
            </tr>
            @endforeach
          </table>
          <table class="table table-bordered text-center">
            <tr>
              <td class=" p-0 m-0 w-50"><b>JAMI NARYAD BLANKA SONI:</b></td>
              <td class=" p-0 m-0 w-50"><b>{{ $MuxirFaktura['count'] }} (dona)</b></td>
            </tr>
          </table>
          <div class="row text-center">
            <div class="col-6">
              <b>ASKUE tizimini tadbiq etish sektori boshligi</b>
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
            <div class="col-12">Menga berilgan naryad bilankalari va muxrlarni saqlash majburiyatlarini bajarmaganligim oqibatida naryad blankalari va muxrlarga nisbatan zarar uchun qonunda belgilangan tartibda javobgar boʻlishim toʻgʻrisida ogoxlantirildim.</div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card">
        <div class="card-body">
          @if($MuxirFaktura['scanner']=='false')
            <h4 class="card-title w-100 text-center">Hisob varaq tasdiqlangan (PDF) faylni yuklang</h4>
            <form action="{{ route('naryad_blanka_faktura_upload') }}" method="post"  enctype="multipart/form-data">
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
            <iframe src="../blanka/{{ $MuxirFaktura['scanner_url'] }}" width="100%" height="600px">
                PDF faylni ko'rsatish imkoni bo'lmagan holda shu matnni ko'rsating.
            </iframe>
            @if(auth()->user()->role==1)
              <form action="{{ route('naryad_blanka_faktura_delete_pdf') }}" method="post">
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
    <form action="{{ route('naryad_blanka_faktura_delete') }}" method="post">
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
