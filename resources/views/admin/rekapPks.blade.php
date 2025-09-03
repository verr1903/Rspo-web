<x-layout>

  <x-slot:title>{{$title}}</x-slot:title>

  <div class="pc-container animate-fadeInUp">
    <div class="pc-content">

      <!-- alert -->
      @if ($errors->any())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $errors->first() }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      <!-- End Alert -->

      <!-- button download excel -->
      <div class="d-flex justify-content-end mb-3 mt-3">
        <button id="downloadExcelBtn" class="btn btn-success">
          Download EXCEL
        </button>
      </div>
      <!-- end download excel -->

      <!-- filter -->
      <form id="filterForm" method="GET" action="{{ route('pks') }}">
        <div class="d-flex justify-content-end gap-2 flex-wrap mb-4 animate-fadeInUp" style="animation-delay:0.20s;">

          <!-- Tanggal Mulai -->
          <div class="d-flex flex-column">
            <label for="startDate" class="form-label mb-1">Tanggal Mulai</label>
            <input type="date" class="form-control w-auto" name="startDate" id="startDate" value="{{ request('startDate') }}">
          </div>

          <!-- Tanggal Akhir -->
          <div class="d-flex flex-column">
            <label for="endDate" class="form-label mb-1">Tanggal Akhir</label>
            <input type="date" class="form-control w-auto" name="endDate" id="endDate" value="{{ request('endDate') }}">
          </div>

          <!-- Nama PKS -->
          <div class="d-flex flex-column">
            <label for="namaPks" class="form-label mb-1">Nama PKS</label>
            <select class="form-select w-auto" name="namaPks" id="namaPks">
              <option value="">Semua PKS</option>
              @foreach($namaPkss as $pksName)
              <option value="{{ $pksName }}" {{ request('namaPks') == $pksName ? 'selected' : '' }}>
                {{ $pksName }}
              </option>
              @endforeach
            </select>
          </div>

          <!-- Tombol Filter -->
          <div class="d-flex flex-column justify-content-end">
            <button type="submit" class="btn btn-primary py-3 px-4">Filter</button>
          </div>

          <!-- tombol reset filter -->
          <div class="d-flex flex-column justify-content-end">
            <button type="button" id="resetFilter" class="btn btn-warning py-3 px-4">
              Reset
            </button>
          </div>

        </div>
      </form>
      <!-- end filter -->

      <div class="row animate-fadeInUp" style="animation-delay:0.20s;">

        <!-- Alert Notifikasi -->
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <script>
          setTimeout(function() {
            const alertElement = document.getElementById('successAlert');
            if (alertElement) {
              const alert = new bootstrap.Alert(alertElement);
              alert.close();
            }
          }, 2500);
        </script>
        @endif

        <div class="col-sm-12">
          <div class="card p-3">

            <!-- Tabel -->
            <table class="table table-bordered text-center">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal Pengiriman</th>
                  <th>Nama PKS</th>
                  <th>Detail</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <!-- pengulangan -->
                @forelse ($pkss as $index => $pks)
                <tr>
                  <td>{{ $loop->iteration + ($pkss->currentPage()-1) * $pkss->perPage() }}</td>
                  <td>{{ $pks->tanggal_pengiriman }}</td>
                  <td>{{ $pks->nama_pks }}</td>

                  <!-- Tombol detail -->
                  <td>
                    <button class="btn btn-info btn-sm btn-detail" style="border-radius:50%;" title="Detail"
                      data-bs-toggle="modal" data-bs-target="#detailModal"
                      data-id="{{ $pks->id }}"
                      data-tanggal="{{ $pks->tanggal_pengiriman }}"
                      data-nama="{{ $pks->nama_pks }}"
                      data-blanko="{{ $pks->nomor_blanko_pb33 }}"
                      data-nopol="{{ $pks->nopol_mobil }}"
                      data-supir="{{ $pks->nama_supir }}"
                      data-foto1="{{ $pks->foto_keseluruhan_pks }}"
                      data-foto2="{{ $pks->foto_sebelum_pks }}"
                      data-foto3="{{ $pks->foto_sesudah_pks }}">
                      <i class="ti ti-eye"></i>
                    </button>
                  </td>

                  <!-- Tombol aksi -->
                  <td>
                    <div class="btn-group" role="group">
                      <!-- button edit -->
                      <button
                        type="button" style="border-radius: 50%;"
                        class="btn btn-warning btn-sm btn-edit me-1"
                        data-bs-toggle="modal"
                        data-bs-target="#editModal"
                        data-id="{{ $pks->id }}"
                        data-tanggal="{{ $pks->tanggal_pengiriman }}"
                        data-pks="{{ $pks->nama_pks }}"
                        data-blanko="{{ $pks->nomor_blanko_pb33 }}"
                        data-nopol="{{ $pks->nopol_mobil }}"
                        data-supir="{{ $pks->nama_supir }}"
                        data-foto1="{{ $pks->foto_keseluruhan_pks }}"
                        data-foto2="{{ $pks->foto_sebelum_pks }}"
                        data-foto3="{{ $pks->foto_sesudah_pks }}">
                        <i class="ti ti-pencil"></i>
                      </button>

                      <!-- button hapus -->
                      <button class="btn btn-sm btn-danger btn-delete me-1" style="border-radius: 50%;"
                        data-id="{{ $pks->id }}" title="Hapus">
                        <i class="ti ti-trash"></i>
                      </button>

                      <!-- button download pdf -->
                      <a href="{{ route('rekapPks.pdf.row', $pks->id) }}" class="btn btn-sm btn-primary"
                        style="border-radius:50%;" title="Download PDF" target="_blank">
                        <i class="ti ti-download"></i>
                      </a>

                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="5">Tidak ada data</td>
                </tr>
                @endforelse
              </tbody>
            </table>

            <!-- form delete -->
            <form id="deleteForm" method="POST" style="display:none;">
              @csrf
              @method('DELETE')
            </form>

            <!-- Pagination -->
            <div class="mt-3">
              @if ($pkss->hasPages())
              <nav>
                <ul class="pagination justify-content-center my-3">
                  @if ($pkss->onFirstPage())
                  <li class="page-item me-2 disabled"><span class="page-link rounded-pill">&laquo;</span></li>
                  @else
                  <li class="page-item me-2">
                    <a class="page-link rounded-pill" href="{{ $pkss->previousPageUrl() }}" rel="prev">&laquo;</a>
                  </li>
                  @endif

                  <!-- Nomor Halaman -->
                  @foreach ($pkss->links()->elements[0] as $page => $url)
                  @if ($page == $pkss->currentPage())
                  <li class="page-item me-2 active">
                    <span class="page-link rounded-pill bg-primary border-0 shadow-sm">{{ $page }}</span>
                  </li>
                  @else
                  <li class="page-item me-2">
                    <a class="page-link rounded-pill hover-shadow" href="{{ $url }}">{{ $page }}</a>
                  </li>
                  @endif
                  @endforeach

                  <!-- Tombol Berikutnya -->
                  @if ($pkss->hasMorePages())
                  <li class="page-item me-2">
                    <a class="page-link rounded-pill" href="{{ $pkss->nextPageUrl() }}" rel="next">&raquo;</a>
                  </li>
                  @else
                  <li class="page-item me-2 disabled"><span class="page-link rounded-pill">&raquo;</span></li>
                  @endif
                </ul>
              </nav>
              @endif
            </div>
            <!-- end pagination -->

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Detail -->
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
              <td data-field="tanggal"></td>
            </tr>
            <tr>
              <th>Nama PKS</th>
              <td data-field="nama"></td>
            </tr>
            <tr>
              <th>Nomor Blanko PB33</th>
              <td data-field="blanko"></td>
            </tr>
            <tr>
              <th>Nopol Mobil</th>
              <td data-field="nopol"></td>
            </tr>
            <tr>
              <th>Nama Supir</th>
              <td data-field="supir"></td>
            </tr>
          </table>

          <div class="row">
            <div class="col-md-4 text-center">
              <label>Gambar 1</label>
              <div><img data-foto="1" style="width: 100px;" class="img-fluid rounded mt-2"></div>
            </div>
            <div class="col-md-4 text-center">
              <label>Gambar 2</label>
              <div><img data-foto="2" style="width: 100px;" class="img-fluid rounded mt-2"></div>
            </div>
            <div class="col-md-4 text-center">
              <label>Gambar 3</label>
              <div><img data-foto="3" style="width: 100px;" class="img-fluid rounded mt-2"></div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  <!-- end modal detail -->

  <!-- Modal Edit (global) -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form id="editForm" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="modal-header">
            <h5 class="modal-title">Edit Pengiriman</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
            <input type="hidden" id="edit_id" name="id">
            <div class="row g-2">

              <!-- Kolom Kiri -->
              <div class="col-md-6">
                <div class="mb-2">
                  <label for="edit_tanggal" class="form-label">Tanggal Pengiriman</label>
                  <input type="date" class="form-control form-control-sm" id="edit_tanggal" name="tanggal_pengiriman" required>
                </div>

                <div class="mb-2">
                  <label for="edit_pks" class="form-label">Nama PKS</label>
                  <select class="form-select form-select-sm" id="edit_pks" name="nama_pks" required>
                    <option value="">-- Pilih PKS --</option>
                    @foreach($listPks as $lp)
                    <option value="{{ $lp->nama_pks }}">{{ $lp->nama_pks }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="mb-2">
                  <label for="edit_blanko" class="form-label">Nomor Blanko</label>
                  <input type="text" class="form-control form-control-sm" id="edit_blanko" name="nomor_blanko_pb33" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-2">
                  <label for="edit_nopol" class="form-label">Nopol Mobil</label>
                  <input type="text" class="form-control form-control-sm" id="edit_nopol" name="nopol_mobil" required>
                </div>

                <div class="mb-2">
                  <label for="edit_supir" class="form-label">Nama Supir</label>
                  <input type="text" class="form-control form-control-sm" id="edit_supir" name="nama_supir" required>
                </div>
              </div>

              <div class="row">
                <!-- gambar 1 -->
                <div class="col-md-4 text-center mb-3">
                  <div class="image-upload-card p-2 rounded shadow-sm border">
                    <!-- Label -->
                    <label for="gambar1" class="form-label fw-bold" style="font-size: 16px;">Gambar 1</label>

                    <!-- Gambar Lama -->
                    <div class="mb-2">
                      <img id="preview1" style="max-height:100px; width:auto;" class="img-fluid rounded border">
                    </div>

                    <!-- Input File -->
                    <div class="mb-2">
                      <input type="file" class="form-control form-control-sm" name="gambar1" id="gambar1_input">
                    </div>

                    <!-- Prview gambar baru -->
                    <div class="mb-1" style="display:none;" id="preview1_wrapper">
                      <label class="form-label small text-muted">Preview Baru:</label>
                      <img id="preview1_new" style="max-height:100px; width:auto;" class="img-fluid rounded border mt-1">
                    </div>
                  </div>
                </div>

                <!-- gambar 2 -->
                <div class="col-md-4 text-center mb-3">
                  <div class="image-upload-card p-2 rounded shadow-sm border">
                    <label for="gambar2" class="form-label fw-bold" style="font-size: 16px;">Gambar 2</label>

                    <!-- Gambar Lama -->
                    <div class="mb-2">
                      <img id="preview2" style="max-height:100px; width:auto;" class="img-fluid rounded border">
                    </div>

                    <!-- Input File -->
                    <div class="mb-2">
                      <input type="file" class="form-control form-control-sm" name="gambar2" id="gambar2_input">
                    </div>

                    <!-- Prview gambar baru -->
                    <div class="mb-1" style="display:none;" id="preview2_wrapper">
                      <label class="form-label small text-muted">Preview Baru:</label>
                      <img id="preview2_new" style="max-height:100px; width:auto;" class="img-fluid rounded border mt-1">
                    </div>
                  </div>
                </div>

                <!-- gambar 3 -->
                <div class="col-md-4 text-center mb-3">
                  <div class="image-upload-card p-2 rounded shadow-sm border">

                    <!-- Label -->
                    <label for="gambar3" class="form-label fw-bold" style="font-size: 16px;">Gambar 3</label>

                    <!-- Gambar Lama -->
                    <div class="mb-2">
                      <img id="preview3" style="max-height:100px; width:auto;" class="img-fluid rounded border">
                    </div>

                    <!-- Input File -->
                    <div class="mb-2">
                      <input type="file" class="form-control form-control-sm" name="gambar3" id="gambar3_input">
                    </div>

                    <!-- Prview gambar baru -->
                    <div class="mb-1" style="display:none;" id="preview3_wrapper">
                      <label class="form-label small text-muted">Preview Baru:</label>
                      <img id="preview3_new" style="max-height:100px; width:auto;" class="img-fluid rounded border mt-1">
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="modal-footer py-2">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- end modal edit -->

  <script>
    // Modal Detail
    document.addEventListener("DOMContentLoaded", function() {
      const detailModal = document.getElementById('detailModal');
      detailModal.addEventListener('show.bs.modal', function(event) {
        let button = event.relatedTarget;

        this.querySelector("td[data-field='tanggal']").textContent = button.getAttribute("data-tanggal");
        this.querySelector("td[data-field='pks']").textContent = button.getAttribute("data-pks");
        this.querySelector("td[data-field='blanko']").textContent = button.getAttribute("data-blanko");
        this.querySelector("td[data-field='nopol']").textContent = button.getAttribute("data-nopol");
        this.querySelector("td[data-field='supir']").textContent = button.getAttribute("data-supir");

        this.querySelector("img[data-foto='1']").src = "/storage/" + button.getAttribute("data-foto1");
        this.querySelector("img[data-foto='2']").src = "/storage/" + button.getAttribute("data-foto2");
        this.querySelector("img[data-foto='3']").src = "/storage/" + button.getAttribute("data-foto3");
      });
    });

    // Modal Edit (global)
    const editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function(event) {
      let button = event.relatedTarget;

      // isi form
      document.getElementById('edit_id').value = button.getAttribute("data-id");
      document.getElementById('edit_tanggal').value = button.getAttribute("data-tanggal");
      document.getElementById('edit_pks').value = button.getAttribute("data-pks");
      document.getElementById('edit_blanko').value = button.getAttribute("data-blanko");
      document.getElementById('edit_nopol').value = button.getAttribute("data-nopol");
      document.getElementById('edit_supir').value = button.getAttribute("data-supir");

      // update action form sesuai id
      document.getElementById('editForm').action = "/rekapPks/" + button.getAttribute("data-id");

      // preview gambar
      document.getElementById('preview1').src = "/storage/" + button.getAttribute("data-foto1");
      document.getElementById('preview2').src = "/storage/" + button.getAttribute("data-foto2");
      document.getElementById('preview3').src = "/storage/" + button.getAttribute("data-foto3");
    });

    // Hapus data dengan SweetAlert
    document.addEventListener("DOMContentLoaded", function() {
      document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
          e.preventDefault(); // mencegah default behavior

          const id = this.getAttribute('data-id');

          Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
              const form = document.getElementById('deleteForm');
              form.action = '/rekapPks/' + id; // route delete
              form.submit(); // submit form
            }
          });
        });
      });
    });

    // preview gambar 1 baru sebelum upload
    document.getElementById('gambar1_input').addEventListener('change', function(e) {
      const preview = document.getElementById('preview1_new');
      const wrapper = document.getElementById('preview1_wrapper');
      const file = e.target.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          wrapper.style.display = 'block';
        }
        reader.readAsDataURL(file);
      } else {
        preview.src = '';
        wrapper.style.display = 'none';
      }
    });

    // preview gambar 2 baru sebelum upload
    document.getElementById('gambar2_input').addEventListener('change', function(e) {
      const preview = document.getElementById('preview2_new');
      const wrapper = document.getElementById('preview2_wrapper');
      const file = e.target.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          wrapper.style.display = 'block';
        }
        reader.readAsDataURL(file);
      } else {
        preview.src = '';
        wrapper.style.display = 'none';
      }
    });

    // preview gambar 3 baru sebelum upload
    document.getElementById('gambar3_input').addEventListener('change', function(e) {
      const preview = document.getElementById('preview3_new');
      const wrapper = document.getElementById('preview3_wrapper');
      const file = e.target.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          wrapper.style.display = 'block';
        }
        reader.readAsDataURL(file);
      } else {
        preview.src = '';
        wrapper.style.display = 'none';
      }
    });

    // Download Excel
    document.getElementById('downloadExcelBtn').addEventListener('click', function(e) {
      e.preventDefault();

      // Cek apakah ada filter aktif
      let startDate = document.getElementById('startDate').value;
      let endDate = document.getElementById('endDate').value;
      let namaPks = document.getElementById('namaPks').value;

      let url = "{{ route('exportExcel.rekapPks') }}";
      let params = [];

      if (startDate) params.push('startDate=' + startDate);
      if (endDate) params.push('endDate=' + endDate);
      if (namaPks) params.push('namaPks=' + namaPks);

      if (params.length > 0) {
        url += "?" + params.join("&");
      }

      let message = (params.length > 0) ?
        "Anda akan mendownload Excel sesuai dengan filter yang dipilih." :
        "Anda akan mendownload Excel berisi seluruh data.";

      Swal.fire({
        title: 'Konfirmasi Download',
        text: message,
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Ya, Download',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = url; // arahkan ke route export
        }
      });
    });

    // Reset filter
    document.getElementById('resetFilter').addEventListener('click', function() {
      Swal.fire({
        title: 'Reset Filter?',
        text: "Semua filter akan dikosongkan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, reset!',
        cancelButtonText: 'Batal'
      }).then(result => {
        if (result.isConfirmed) {
          // kosongkan semua input filter
          document.getElementById('filterForm').reset();
          // redirect ke index tanpa query string (biar tampil semua data)
          window.location.href = "{{ route('pks') }}";
        }
      })
    });
  </script>

</x-layout>