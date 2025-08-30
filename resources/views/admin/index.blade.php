<x-layout>
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
                <h2 class="mb-0 fw-bold">18 <span>pengiriman</span></h2>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-6 mb-4">
            <div class="card card-custom bg-blue animate-fadeInUp" style="animation-delay:0.20s;">
              <div class="card-body">
                <h4 class="mb-2 fw-bold">Total Pengiriman PKS</h4>
                <h2 class="mb-0 fw-bold">18 <span>pengiriman</span></h2>
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
</x-layout>