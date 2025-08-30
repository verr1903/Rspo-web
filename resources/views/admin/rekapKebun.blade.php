<x-layout>

<x-slot:title>{{$title}}</x-slot:title>

  <!-- [ Main Content ] start -->
  <div class="pc-container animate-fadeInUp">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->

      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="d-flex justify-content-end mb-3 mt-3 animate-fadeInUp" style="animation-delay:0.20s;">
        <button type="button" id="downloadExcel" class="btn btn-success">
          Download EXCEL
        </button>
      </div>

      <div class="row mb-3 animate-fadeInUp" style="animation-delay:0.20s;">
        <div class="col-12">
          <div class="d-flex justify-content-end gap-2 flex-wrap">

            <!-- Filter Tanggal -->
            <div class="d-flex flex-column">
              <label for="startDate" class="form-label mb-1">Tanggal Mulai</label>
              <input type="date" class="form-control w-auto" id="startDate">
            </div>

            <div class="d-flex flex-column">
              <label for="endDate" class="form-label mb-1">Tanggal Akhir</label>
              <input type="date" class="form-control w-auto" id="endDate">
            </div>

            <!-- Filter Nama Kebun -->
            <div class="d-flex flex-column">
              <label for="namaKebun" class="form-label mb-1">Nama Kebun</label>
              <select class="form-select w-auto" id="namaKebun">
                <option value="">-- Pilih Kebun --</option>
                <option value="Kebun A">Kebun A</option>
                <option value="Kebun B">Kebun B</option>
                <option value="Kebun C">Kebun C</option>
              </select>
            </div>

            <!-- Tombol Filter -->
            <div class="d-flex flex-column justify-content-end">
              <button id="filterDate" class="btn btn-primary py-3">Filter</button>
            </div>

          </div>
        </div>
      </div>


      <div class="row animate-fadeInUp" style="animation-delay:0.20s;">
        <!-- [ Typography ] start -->
        <div class="col-sm-12">
          <div class="card p-3">
            <!-- Tabel -->
            <table class="table table-bordered text-center">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal Pengiriman</th>
                  <th>Nama Kebun</th>
                  <th>Afdeling</th>
                  <th>Detail</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>2025-08-28</td>
                  <td>PTPN 5</td>
                  <td>Pabrik A</td>
                  <!-- Tombol detail -->
                  <td>
                    <button class="btn btn-info btn-sm" style="border-radius:50%;" title="Detail" data-bs-toggle="modal"
                      data-bs-target="#detailModal">
                      <i class="ti ti-eye"></i>
                    </button>
                  </td>
                  <!-- Tombol aksi -->
                  <td>
                    <div class="btn-group" role="group">
                      <button class="me-1 btn btn-sm btn-warning" style="border-radius: 50%;" title="Edit"
                        data-bs-toggle="modal" data-bs-target="#editModal" data-tanggal="2025-08-28" data-kebun="PTPN 5"
                        data-tujuan="Pabrik A">
                        <i class="ti ti-pencil"></i>
                      </button>
                      <button class="me-1 btn btn-sm btn-danger" style="border-radius: 50%;" title="Hapus" data-id="1">
                        <i class="ti ti-trash"></i>
                      </button>
                      <a href="/../Review Proposal - Cover Map.pdf" class="btn btn-sm btn-primary"
                        style="border-radius:50%;" title="Download PDF" target="_blank">
                        <i class="ti ti-download"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- [ Typography ] end -->
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>
  <!-- [ Main Content ] end -->

  <!-- Modal Detail (seperti sebelumnya) -->
  <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Pengiriman</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <!-- Informasi -->
          <table class="table table-bordered">
            <tr>
              <th>Tanggal Pengiriman</th>
              <td>2025-08-28</td>
            </tr>
            <tr>
              <th>Nama Kebun</th>
              <td>PTPN 5</td>
            </tr>
            <tr>
              <th>Afdeling</th>
              <td>Pabrik A</td>
            </tr>
            <tr>
              <th>Nomor Blanko PB 25</th>
              <td>PB33-1234</td>
            </tr>
            <tr>
              <th>Nopol Mobil</th>
              <td>BM 1234 CD</td>
            </tr>
            <tr>
              <th>Nama Supir</th>
              <td>Budi Santoso</td>
            </tr>
          </table>
          <!-- 3 Gambar -->
          <div class="row">
            <div class="col-md-4 text-center">
              <label>Gambar 1</label>
              <div>
                <img src="/../assets/images/logo-ptpn-no-font.png" style="width: 100px;" class=" img-fluid rounded mt-2"
                  alt="Gambar 1">
              </div>
            </div>

            <div class="col-md-4 text-center">
              <label>Gambar 2</label>
              <div>
                <img src="/../assets/images/logo-ptpn-no-font.png" style="width: 100px;" class=" img-fluid rounded mt-2"
                  alt="Gambar 1">
              </div>
            </div>

            <div class="col-md-4 text-center">
              <label>Gambar 3</label>
              <div>
                <img src="/../assets/images/logo-ptpn-no-font.png" style="width: 100px;" class=" img-fluid rounded mt-2"
                  alt="Gambar 1">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Pengiriman</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="formEditDetail">
            <div class="row">
              <!-- Kolom Kiri -->
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Tanggal Pengiriman</label>
                  <input type="date" class="form-control" name="tanggal" value="2025-08-28">
                </div>
                <div class="mb-3">
                  <label class="form-label">Nama Kebun</label>
                  <input type="text" class="form-control" name="kebun" value="PTPN 5">
                </div>
                <div class="mb-3">
                  <label class="form-label">Afdeling</label>
                  <input type="text" class="form-control" name="tujuan" value="Pabrik A">
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Nomor Blanko PB 25</label>
                  <input type="text" class="form-control" name="blanko" value="PB33-1234">
                </div>
                <div class="mb-3">
                  <label class="form-label">Nopol Mobil</label>
                  <input type="text" class="form-control" name="nopol" value="BM 1234 CD">
                </div>
                <div class="mb-3">
                  <label class="form-label">Nama Supir</label>
                  <input type="text" class="form-control" name="supir" value="Budi Santoso">
                </div>
              </div>

              <!-- Kolom Kanan (untuk upload gambar) -->
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Gambar 1</label>
                  <input type="file" class="form-control" name="gambar1">
                  <div class="text-center">
                    <img src="/../assets/images/logo-ptpn-no-font.png" style="width: 100px;"
                      class=" img-fluid rounded mt-2" alt="Gambar 1">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Gambar 2</label>
                  <input type="file" class="form-control" name="gambar2">
                  <div class="text-center">
                    <img src="/../assets/images/logo-ptpn-no-font.png" style="width: 100px;"
                      class=" img-fluid rounded mt-2" alt="Gambar 2">
                  </div>
                </div>
              </div>
              <div class="offset-3 col-md-6">
                <div class="mb-3">
                  <label class="form-label">Gambar 3</label>
                  <input type="file" class="form-control" name="gambar3">
                  <div class="text-center">
                    <img src="/../assets/images/logo-ptpn-no-font.png" style="width: 100px;"
                      class=" img-fluid rounded mt-2" alt="Gambar 3">
                  </div>
                </div>
              </div>
            </div>
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary" form="editForm">Simpan Perubahan</button>
        </div>
      </div>
    </div>
  </div>

</x-layout>