<x-layout>

  <div class="pc-container animate-fadeInUp">
    <div class="pc-content">

      <!--[ Main Content ] start-->
      <div class="row mt-3 animate-fadeInUp" style="animation-delay:0.20s;">
        <!--[ tabler-icon ] start-->
        <div class="col-sm-12">
          <div class="card p-3">
            <h5 class="mb-3"><i class="ti ti-clipboard-text"></i> Input Data</h5>
            <form id="addDataForm" class="row g-3">
              <div class="col-md-4">
                <label for="dataType" class="form-label">Pilih Jenis Data</label>
                <select class="form-select" id="dataType" required>
                  <option value="">-- Pilih --</option>
                  <option value="Nama PKS">Nama PKS</option>
                  <option value="Nama Kebun">Nama Kebun</option>
                  <option value="Afdeling">Afdeling</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="dataValue" class="form-label">Masukkan Data</label>
                <input type="text" class="form-control" id="dataValue" placeholder="Masukkan nama..." required>
              </div>
              <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-success w-100 mb-1">Tambah</button>
              </div>
            </form>

            <hr class="my-4">

            <h5 class="mb-3"><i class="ti ti-list-details"></i> Data Tersimpan</h5>
            <table class="table table-bordered text-center" id="dataTable">
              <thead class="table-light">
                <tr>
                  <th>Nama PKS</th>
                  <th>Nama Kebun</th>
                  <th>Afdeling</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fatfat</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!--[ tabler-icon ] end-->
      </div>
      <!--[ Main Content ] end-->
    </div>
  </div>

</x-layout>

<script>
// Event submit form Tambah Data
document.getElementById('addDataForm').addEventListener('submit', function (e) {
  e.preventDefault(); // mencegah reload halaman

  const dataType = document.getElementById('dataType').value;
  const dataValue = document.getElementById('dataValue').value.trim();

  if (dataType === "" || dataValue === "") {
    Swal.fire({
      icon: 'warning',
      title: 'Oops...',
      text: 'Jenis data dan nilai harus diisi!',
      confirmButtonText: 'OK',
      customClass: {
        confirmButton: 'btn btn-warning'
      },
      buttonsStyling: false
    });
    return;
  }

  // Tampilkan SweetAlert konfirmasi
  Swal.fire({
    title: 'Tambah Data?',
    text: `${dataType}: ${dataValue}`,
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Ya, Simpan',
    cancelButtonText: 'Batal',
    customClass: {
      confirmButton: 'btn btn-success me-2',
      cancelButton: 'btn btn-secondary'
    },
    buttonsStyling: false
  }).then((result) => {
    if (result.isConfirmed) {
      // Cari index kolom sesuai jenis data
      let colIndex = 0;
      if (dataType === 'Nama PKS') colIndex = 0;
      else if (dataType === 'Nama Kebun') colIndex = 1;
      else if (dataType === 'Afdeling') colIndex = 2;

      // Tambah data ke tabel (baris baru)
      const table = document.getElementById('dataTable').querySelector('tbody');
      const newRow = table.insertRow();
      for (let i = 0; i < 3; i++) {
        const newCell = newRow.insertCell(i);
        newCell.textContent = (i === colIndex) ? dataValue : '-';
      }

      // Reset form
      document.getElementById('addDataForm').reset();

      // SweetAlert sukses
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'Data berhasil ditambahkan.',
        confirmButtonText: 'OK',
        customClass: {
          confirmButton: 'btn btn-success'
        },
        buttonsStyling: false
      });
    }
  });
});

document.getElementById('dataTable').addEventListener('click', function (e) {
  if (e.target && e.target.tagName === 'TD') {
    const cell = e.target;
    const oldValue = cell.textContent.trim();

    Swal.fire({
      title: 'Pilih Aksi',
      text: `Data: ${oldValue}`,
      icon: 'info',
      showDenyButton: true,
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonText: 'Edit',   // kiri
      denyButtonText: 'Hapus',     // tengah
      cancelButtonText: 'Tutup',   // kanan
      reverseButtons: false, // biar urutan: [Edit, Hapus, Tutup]
      customClass: {
        denyButton: 'btn btn-danger mx-2',     // merah
        cancelButton: 'btn btn-secondary',     // abu-abu
        confirmButton: 'btn btn-primary'       // biru default
      },
      buttonsStyling: false // agar class bootstrap dipakai
    }).then((result) => {
      if (result.isConfirmed) {
        // Edit data
        Swal.fire({
          title: 'Edit Data',
          input: 'text',
          inputValue: oldValue,
          showCancelButton: true,
          confirmButtonText: 'Simpan',
          cancelButtonText: 'Batal',
          customClass: {
            confirmButton: 'btn btn-primary me-2',
            cancelButton: 'btn btn-secondary'
          },
          buttonsStyling: false
        }).then((editResult) => {
          if (editResult.isConfirmed && editResult.value.trim() !== '') {
            cell.textContent = editResult.value;
            Swal.fire('Berhasil!', 'Data telah diperbarui.', 'success');
          }
        });
      } else if (result.isDenied) {
        // Hapus data
        Swal.fire({
          title: 'Yakin Hapus?',
          text: `Data "${oldValue}" akan dihapus!`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Hapus!',
          cancelButtonText: 'Batal',
          customClass: {
            confirmButton: 'btn btn-danger me-2',
            cancelButton: 'btn btn-secondary'
          },
          buttonsStyling: false
        }).then((deleteResult) => {
          if (deleteResult.isConfirmed) {
            cell.textContent = '';
            Swal.fire('Dihapus!', 'Data telah dihapus.', 'success');
          }
        });
      }
    });
  }
});

</script>