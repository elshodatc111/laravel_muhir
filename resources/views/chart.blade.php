@extends('layouts.layout')

@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Statistika</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active">Statistika</li>
    </ol>
  </nav>
</div>

<div class="row">

  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title w-100 text-center">Markaziy omborga kelgan muxirlar</h5>
        <div id="lineChart"></div>
        <script>
          document.addEventListener("DOMContentLoaded", () => {
            new ApexCharts(document.querySelector("#lineChart"), {
              series: [{
                name: "Muxirlar soni:",
                data: [
                  @foreach($keldi as $item)
                    '{{ $item }}',
                  @endforeach
                ]
              }],
              chart: {
                height: 350,
                type: 'line',
                zoom: {
                  enabled: false
                }
              },
              dataLabels: {
                enabled: false
              },
              stroke: {
                curve: 'straight'
              },
              grid: {
                row: {
                  colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                  opacity: 0.5
                },
              },
              xaxis: {
                categories: [
                  @foreach($Monchs['Y-M'] as $item)
                  '{{ $item }}',
                  @endforeach
                ],
              }
            }).render();
          });
        </script>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title w-100 text-center">Markaziy ombordan tarqatilgan muxirlar</h5>
        <div id="tarqatilgan"></div>
        <script>
          document.addEventListener("DOMContentLoaded", () => {
            new ApexCharts(document.querySelector("#tarqatilgan"), {
              series: [{
                name: "Muxirlar soni:",
                data: [
                  @foreach($ketdi as $item)
                  '{{ $item }}',
                  @endforeach
                ]
              }],
              chart: {
                height: 350,
                type: 'line',
                zoom: {
                  enabled: false
                }
              },
              dataLabels: {
                enabled: false
              },
              stroke: {
                curve: 'straight'
              },
              grid: {
                row: {
                  colors: ['#f3f3f3', 'transparent'],
                  opacity: 0.5
                },
              },
              xaxis: {
                categories: [
                  @foreach($Monchs['Y-M'] as $item)
                  '{{ $item }}',
                  @endforeach
                ],
              }
            }).render();
          });
        </script>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title w-100 text-center">Bo'limlarga tarqatilgan muxirlar</h5>
        <div id="columnChart"></div>
        <script>
          document.addEventListener("DOMContentLoaded", () => {
            new ApexCharts(document.querySelector("#columnChart"), {
              series: [{
                name: 'Mavsum boshidan',
                data: [
                  @foreach($MavsuBoshidan as $item)
                    '{{ $item }}',
                  @endforeach
                ]
              }, {
                name: 'Yil boshidan',
                data: [
                  @foreach($YilBoshidan as $item)
                    '{{ $item }}',
                  @endforeach
                ]
              }, {
                name: 'Oy boshidan',
                data: [
                  @foreach($OyBoshidan as $item)
                    '{{ $item }}',
                  @endforeach
                ]
              }],
              chart: {
                type: 'bar',
                height: 350
              },
              plotOptions: {
                bar: {
                  horizontal: false,
                  columnWidth: '55%',
                  endingShape: 'rounded'
                },
              },
              dataLabels: {
                enabled: false
              },
              stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
              },
              xaxis: {
                categories: [
                  @foreach($bolimlar2 as $key => $item)
                  "{{ $item }}",
                  @endforeach
                ],
              },
              yaxis: {
                title: {
                  text: 'Muxir soni'
                }
              },
              fill: {
                opacity: 1
              },
              tooltip: {
                y: {
                  formatter: function(val) {
                    return " " + val + " "
                  }
                }
              }
            }).render();
          });
        </script>
      </div>
    </div>
  </div>
</div>
</section>

</main>
@endsection
