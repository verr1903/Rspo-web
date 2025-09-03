<x-layout>

  <x-slot:title>{{$title}}</x-slot:title>
  <div class="pc-container animate-fadeInUp">
    <div class="pc-content">

      <!--[ Main Content ] start-->
      <div class="row mt-3 animate-fadeInUp" style="animation-delay:0.20s;">
        <!--[ tabler-icon ] start-->
        <div class="col-sm-12">
          <div class="card p-3">
            <h5 class="mb-3 ms-2"><i class="ti ti-clipboard-text"></i> Input Data</h5>

            <!-- dropdown pilihan input data -->
            <div class="mb-3">
              <label class="form-label ms-2">Pilih Form</label>
              <select id="formSelector" class="form-select" onchange="formSelector()">
                <option value="">-- Pilih Data yang Ingin Ditambahkan --</option>
                <option value="pks">Tambah PKS</option>
                <option value="kebun">Tambah Kebun</option>
                <option value="afdeling">Tambah Afdeling</option>
              </select>
            </div>

            {{-- Tambah PKS --}}
            <div id="formPks" style="display:none;">
              <form action="{{ route('list-pks.store') }}" method="POST" class="row g-3 mb-4">
                @csrf
                <div class="col-md-10">
                  <label class="form-label">Nama PKS</label>
                  <input type="text" id="nama_pks" name="nama_pks" class="form-control" placeholder="Masukkan Nama PKS..." required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                  <button type="submit" class="btn btn-success w-100">Tambah</button>
                </div>
              </form>
            </div>

            {{-- Tambah Kebun --}}
            <div id="formKebun" style="display:none;">
              <form action="{{ route('list-kebun.store') }}" method="POST" class="row g-3 mb-4">
                @csrf
                <div class="col-md-10">
                  <label class="form-label">Nama Kebun</label>
                  <input type="text" id="nama_kebun" name="nama_kebun" class="form-control" placeholder="Masukkan Nama Kebun..." required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                  <button type="submit" class="btn btn-success w-100">Tambah</button>
                </div>
              </form>
            </div>

            {{-- Tambah Afdeling --}}
            <div id="formAfdeling" style="display:none;">
              <form action="{{ route('list-afdeling.store') }}" method="POST" class="row g-3 mb-4">
                @csrf
                <div class="col-md-10">
                  <label class="form-label">Afdeling</label>
                  <input type="text" id="afdeling" name="afdeling" class="form-control" placeholder="Masukkan Afdeling..." required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                  <button type="submit" class="btn btn-success w-100">Tambah</button>
                </div>
              </form>
            </div>

            <hr class="my-4">

            <h5 class="mb-3"><i class="ti ti-list-details"></i> Data Tersimpan</h5>
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

            <div class="row">
              {{-- Tabel PKS --}}
              <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                  <div class="card-header bg-success">
                    <h6 class="mb-0 text-white">Daftar PKS</h6>
                  </div>
                  <div class="card-body">
                    <table class="table table-hover text-center">
                      <thead class="table-light">
                        <tr>
                          <th>No</th>
                          <th>Nama PKS</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($pks as $index => $item)
                        <tr data-id="{{ $item->id }}" data-type="list-pks" data-nama="{{ $item->nama_pks }}">
                          <td>{{ $index + 1 }}</td>
                          <td>{{ $item->nama_pks }}</td>
                          <td>
                            <button class="btn btn-sm btn-warning" style="border-radius: 50%;" data-bs-toggle="modal" data-bs-target="#editPksModal" data-id="{{ $item->id }}" data-nama="{{ $item->nama_pks }}"><i class="ti ti-edit"></i></button>

                            <form action="{{ route('list-pks.destroy', $item->id) }}" method="POST" style="display:inline-block">
                              @csrf
                              @method('DELETE')
                              <button type="button" class="btn btn-sm btn-danger btn-delete" style="border-radius: 50%;"><i class="ti ti-trash"></i></button>
                            </form>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              {{-- Tabel Kebun --}}
              <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                  <div class="card-header bg-primary">
                    <h6 class="mb-0 text-white">Daftar Kebun</h6>
                  </div>
                  <div class="card-body">
                    <table class="table table-hover text-center">
                      <thead class="table-light">
                        <tr>
                          <th>No</th>
                          <th>Nama Kebun</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($kebun as $index => $item)
                        <tr data-id="{{ $item->id }}" data-type="list-kebun" data-nama="{{ $item->nama_kebun }}">
                          <td>{{ $index + 1 }}</td>
                          <td>{{ $item->nama_kebun }}</td>
                          <td>
                            <button class="btn btn-sm btn-warning btn-edit-kebun" style="border-radius: 50%;" data-bs-toggle="modal" data-bs-target="#editKebunModal" data-id="{{ $item->id }}" data-nama="{{ $item->nama_kebun }}"><i class="ti ti-edit"></i></button>

                            <form action="{{ route('list-kebun.destroy', $item->id) }}" method="POST" style="display:inline-block">
                              @csrf
                              @method('DELETE')
                              <button type="button" class="btn btn-sm btn-danger btn-delete" style="border-radius: 50%;"><i class="ti ti-trash"></i></button>
                            </form>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              {{-- Tabel Afdeling --}}
              <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                  <div class="card-header bg-warning">
                    <h6 class="mb-0 text-white">Daftar Afdeling</h6>
                  </div>
                  <div class="card-body">
                    <table class="table table-hover text-center">
                      <thead class="table-light">
                        <tr>
                          <th>No</th>
                          <th>Afdeling</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($afdeling as $index => $item)
                        <tr data-id="{{ $item->id }}" data-type="list-afdeling" data-nama="{{ $item->afdeling }}">
                          <td>{{ $index + 1 }}</td>
                          <td>{{ $item->afdeling }}</td>
                          <td>
                            <button class="btn btn-sm btn-warning btn-edit-afdeling" style="border-radius: 50%;" data-bs-toggle="modal" data-bs-target="#editAfdelingModal" data-id="{{ $item->id }}" data-nama="{{ $item->afdeling }}"><i class="ti ti-edit"></i></button>

                            <form action="{{ route('list-afdeling.destroy', $item->id) }}" method="POST" style="display:inline-block">
                              @csrf
                              @method('DELETE')
                              <button type="button" class="btn btn-sm btn-danger btn-delete" style="border-radius: 50%;"><i class="ti ti-trash"></i></button>
                            </form>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <!--[ tabler-icon ] end-->
      </div>
      <!--[ Main Content ] end-->
    </div>
  </div>

  <!-- Modal Edit PKS -->
  <div class="modal fade" id="editPksModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form id="editPksForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit PKS</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id" id="editPksId">
            <div class="mb-3">
              <label class="form-label">Nama PKS</label>
              <input type="text" name="nama_pks" class="form-control" id="editPksNama" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Edit Kebun -->
  <div class="modal fade" id="editKebunModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form id="editKebunForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Kebun</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id" id="editKebunId">
            <div class="mb-3">
              <label class="form-label">Nama Kebun</label>
              <input type="text" name="nama_kebun" class="form-control" id="editKebunNama" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Edit Afdeling -->
  <div class="modal fade" id="editAfdelingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form id="editAfdelingForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Afdeling</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id" id="editAfdelingId">
            <div class="mb-3">
              <label class="form-label">Afdeling</label>
              <input type="text" name="afdeling" class="form-control" id="editAfdelingNama" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

</x-layout>

<script>
  function formSelector() {
    let selected = document.getElementById('formSelector').value;

    document.getElementById('formPks').style.display = 'none';
    document.getElementById('formKebun').style.display = 'none';
    document.getElementById('formAfdeling').style.display = 'none';

    if (selected === 'pks') document.getElementById('formPks').style.display = 'block';
    else if (selected === 'kebun') document.getElementById('formKebun').style.display = 'block';
    else if (selected === 'afdeling') document.getElementById('formAfdeling').style.display = 'block';
  }

  // Delete confirmation
  document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function() {
      const form = this.closest('form');
      Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data yang dihapus tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) form.submit();
      });
    });
  });

  // Edit PKS
  document.querySelectorAll('[data-bs-target="#editPksModal"]').forEach(button => {
    button.addEventListener('click', function() {
      const id = this.getAttribute('data-id');
      const nama = this.getAttribute('data-nama');
      document.getElementById('editPksId').value = id;
      document.getElementById('editPksNama').value = nama;
      document.getElementById('editPksForm').action = "/list-pks/" + id;
    });
  });

  // Edit Kebun
  document.querySelectorAll('.btn-edit-kebun').forEach(button => {
    button.addEventListener('click', function() {
      const id = this.getAttribute('data-id');
      const nama = this.getAttribute('data-nama');
      document.getElementById('editKebunId').value = id;
      document.getElementById('editKebunNama').value = nama;
      document.getElementById('editKebunForm').action = "/list-kebun/" + id;
    });
  });

  // Edit Afdeling
  document.querySelectorAll('.btn-edit-afdeling').forEach(button => {
    button.addEventListener('click', function() {
      const id = this.getAttribute('data-id');
      const nama = this.getAttribute('data-nama');
      document.getElementById('editAfdelingId').value = id;
      document.getElementById('editAfdelingNama').value = nama;
      document.getElementById('editAfdelingForm').action = "/list-afdeling/" + id;
    });
  });
</script>
