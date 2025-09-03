<x-layout>

  <x-slot:title>{{$title}}</x-slot:title>
  <style>
    html {
      overflow-y: scroll;
      /* scrollbar vertikal selalu tampil */
    }
  </style>
  <div class="pc-container animate-fadeInUp">
    <div class="pc-content">
      <div class="row mt-3">
        <!-- Total Pengiriman Kebun -->
        <div class="row mt-3">
          <div class="col-md-6 col-xl-6 mb-4">
            <div class="card card-custom bg-green animate-fadeInUp" style="animation-delay:0.20s;">
              <div class="card-body">
                <h4 class="mb-2 fw-bold">Total Pengiriman Kebun</h4>
                <h2 class="mb-0 fw-bold">{{ $totalKebun }} <span>pengiriman</span></h2>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-6 mb-4">
            <div class="card card-custom bg-blue animate-fadeInUp" style="animation-delay:0.20s;">
              <div class="card-body">
                <h4 class="mb-2 fw-bold">Total Pengiriman PKS</h4>
                <h2 class="mb-0 fw-bold">{{ $totalPks }} <span>pengiriman</span></h2>
              </div>
            </div>
          </div>
          <div class="col-md-12 col-xl-12">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <h5 class="mb-0">Grafik Pengiriman</h5>
              <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link animate-fadeInUp" style="animation-delay:0.20s;" id="chart-tab-home-tab" data-bs-toggle="pill"
                    data-bs-target="#chart-tab-home" type="button" role="tab" aria-controls="chart-tab-home"
                    aria-selected="true">Bulan</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link active animate-fadeInUp" style="animation-delay:0.20s;" id="chart-tab-profile-tab" data-bs-toggle="pill"
                    data-bs-target="#chart-tab-profile" type="button" role="tab" aria-controls="chart-tab-profile"
                    aria-selected="false">Minggu</button>
                </li>
              </ul>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="tab-content" id="chart-tab-tabContent">
                  <div class="tab-pane" id="chart-tab-home" role="tabpanel" aria-labelledby="chart-tab-home-tab"
                    tabindex="0">
                    <div id="visitor-chart-1"></div>
                  </div>
                  <div class="tab-pane show active" id="chart-tab-profile" role="tabpanel"
                    aria-labelledby="chart-tab-profile-tab" tabindex="0">
                    <div id="visitor-chart"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    'use strict';
    let chartMinggu;
    let chartBulan;

    document.addEventListener('DOMContentLoaded', function() {
      setTimeout(function() {
        floatchart();
      }, 500);

      // Tambah listener bootstrap tab
      document.querySelectorAll('button[data-bs-toggle="pill"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', function(event) {
          if (event.target.id === 'chart-tab-profile-tab') {
            // Tab Minggu aktif
            if (chartMinggu) {
              chartMinggu.destroy(); // hancurkan supaya render ulang
              renderChartMinggu();
            }
          } else if (event.target.id === 'chart-tab-home-tab') {
            // Tab Bulan aktif
            if (chartBulan) {
              chartBulan.destroy();
              renderChartBulan();
            }
          }
        });
      });
    });

    function floatchart() {
      renderChartMinggu();
      renderChartBulan();

      // Chart ketiga (income overview) tetap seperti biasa
      (function() {
        var options = {
          chart: {
            type: 'bar',
            height: 365,
            toolbar: {
              show: false
            }
          },
          colors: ['#13c2c2'],
          plotOptions: {
            bar: {
              columnWidth: '45%',
              borderRadius: 4
            }
          },
          dataLabels: {
            enabled: false
          },
          series: [{
            data: [80, 95, 70, 42, 65, 55, 78]
          }],
          stroke: {
            curve: 'smooth',
            width: 2
          },
          xaxis: {
            categories: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
            axisBorder: {
              show: false
            },
            axisTicks: {
              show: false
            }
          },
          yaxis: {
            show: false
          },
          grid: {
            show: false
          }
        };
        new ApexCharts(document.querySelector('#income-overview-chart'), options).render();
      })();
    }

    function renderChartMinggu() {
      var options = {
        chart: {
          height: 450,
          type: 'area',
          toolbar: {
            show: false
          },
          animations: {
            enabled: true,
            easing: 'easeout',
            speed: 1000
          } // animasi naik
        },
        dataLabels: {
          enabled: false
        },
        colors: ['#24c488', '#08acfc'],
        series: [{
            name: 'Pengiriman Kebun',
            data: [31, 40, 28, 51, 42, 109, 100]
          },
          {
            name: 'Pengiriman PKS',
            data: [11, 32, 45, 32, 34, 52, 41]
          }
        ],
        stroke: {
          curve: 'smooth',
          width: 2
        },
        xaxis: {
          categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
        }
      };
      chartMinggu = new ApexCharts(document.querySelector('#visitor-chart'), options);
      chartMinggu.render();
    }

    function renderChartBulan() {
      var options1 = {
        chart: {
          height: 450,
          type: 'area',
          toolbar: {
            show: false
          },
          animations: {
            enabled: true,
            easing: 'easeout',
            speed: 1000
          }
        },
        dataLabels: {
          enabled: false
        },
        colors: ['#24c488', '#08acfc'],
        series: [{
            name: 'Pengiriman Kebun',
            data: [76, 85, 101, 98, 87, 105, 91, 114, 94, 86, 115, 35]
          },
          {
            name: 'Pengiriman PKS',
            data: [110, 60, 150, 35, 60, 36, 26, 45, 65, 52, 53, 41]
          }
        ],
        stroke: {
          curve: 'smooth',
          width: 2
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        }
      };
      chartBulan = new ApexCharts(document.querySelector('#visitor-chart-1'), options1);
      chartBulan.render();
    }
  </script>

</x-layout>