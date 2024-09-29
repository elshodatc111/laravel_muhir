@extends('layouts.layout')

@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Chart</a></li>
      <li class="breadcrumb-item active">Mavjud muxirlar</li>
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
                data: [10, 41, 35, 51, 49, 62, 69, 91, 148, 69, 91, 148]
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
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Jul', 'Aug', 'Sep'],
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
                data: [10, 41, 35, 51, 49, 62, 69, 91, 148, 69, 91, 148]
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
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Jul', 'Aug', 'Sep'],
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
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66, 55, 57, 56, 61, 58, 63, 60, 66]
              }, {
                name: 'Yil boshidan',
                data: [76, 85, 101, 98, 87, 105, 91, 114, 94, 55, 57, 56, 61, 58, 63, 60, 66]
              }, {
                name: 'Oy boshidan',
                data: [35, 41, 36, 26, 45, 48, 52, 53, 41, 55, 57, 56, 61, 58, 63, 60, 66]
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
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
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
        <!-- End Column Chart -->

      </div>
    </div>
  </div>
</div>
</section>

</main>
@endsection
