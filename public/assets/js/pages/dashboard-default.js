'use strict';
let chartMinggu;
let chartBulan;

document.addEventListener('DOMContentLoaded', function () {
  setTimeout(function () {
    floatchart();
  }, 500);

  // Tambah listener bootstrap tab
  document.querySelectorAll('button[data-bs-toggle="pill"]').forEach(tab => {
    tab.addEventListener('shown.bs.tab', function (event) {
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
  (function () {
    var options = {
      chart: { type: 'bar', height: 365, toolbar: { show: false } },
      colors: ['#13c2c2'],
      plotOptions: { bar: { columnWidth: '45%', borderRadius: 4 } },
      dataLabels: { enabled: false },
      series: [{ data: [80, 95, 70, 42, 65, 55, 78] }],
      stroke: { curve: 'smooth', width: 2 },
      xaxis: { categories: ['Mo','Tu','We','Th','Fr','Sa','Su'], axisBorder:{show:false}, axisTicks:{show:false}},
      yaxis: { show: false },
      grid: { show: false }
    };
    new ApexCharts(document.querySelector('#income-overview-chart'), options).render();
  })();
}

function renderChartMinggu() {
  var options = {
    chart: {
      height: 450,
      type: 'area',
      toolbar: { show: false },
      animations: { enabled: true, easing: 'easeout', speed: 1000 } // animasi naik
    },
    dataLabels: { enabled: false },
    colors: ['#24c488', '#08acfc'],
    series: [
      { name: 'Pengiriman Kebun', data: [31, 40, 28, 51, 42, 109, 100] },
      { name: 'Pengiriman PKS', data: [11, 32, 45, 32, 34, 52, 41] }
    ],
    stroke: { curve: 'smooth', width: 2 },
    xaxis: { categories: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'] }
  };
  chartMinggu = new ApexCharts(document.querySelector('#visitor-chart'), options);
  chartMinggu.render();
}

function renderChartBulan() {
  var options1 = {
    chart: {
      height: 450,
      type: 'area',
      toolbar: { show: false },
      animations: { enabled: true, easing: 'easeout', speed: 1000 }
    },
    dataLabels: { enabled: false },
    colors: ['#24c488', '#08acfc'],
    series: [
      { name: 'Pengiriman Kebun', data: [76,85,101,98,87,105,91,114,94,86,115,35] },
      { name: 'Pengiriman PKS', data: [110,60,150,35,60,36,26,45,65,52,53,41] }
    ],
    stroke: { curve: 'smooth', width: 2 },
    xaxis: { categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'] }
  };
  chartBulan = new ApexCharts(document.querySelector('#visitor-chart-1'), options1);
  chartBulan.render();
}
