<?php
header('Content-Type: application/json');

include 'connection.php'; // panggil file koneksi

// Ambil data dari form-data
$tanggal = $_POST['tanggal'] ?? '';
$nama_pks = $_POST['nama_pks'] ?? '';
$tujuan = $_POST['tujuan'] ?? '';
$blanko = $_POST['blanko'] ?? '';
$nopol = $_POST['nopol'] ?? '';
$supir = $_POST['supir'] ?? '';

// Fungsi upload file
function uploadFile($file, $folder = 'pks/')
{
    if (isset($file) && $file['error'] == 0) {
        // Path ke storage/app/public/pks/
        $basePath = __DIR__ . '/../../storage/app/public/' . $folder;

        // Buat folder kalau belum ada
        if (!is_dir($basePath)) mkdir($basePath, 0777, true);

        // Ambil nama asli file (biar ada ekstensi)
        $filename = time() . '_' . $file['name'];

        $target = $basePath . $filename;

        // Simpan file ke folder
        if (move_uploaded_file($file['tmp_name'], $target)) {
            return $folder . $filename;
        }
    }
    return null;
}

// Upload foto sesuai kolom di database
$foto_keseluruhan = uploadFile($_FILES['foto1'] ?? null);
$foto_sebelum = uploadFile($_FILES['foto2'] ?? null);
$foto_sesudah = uploadFile($_FILES['foto3'] ?? null);

// Prepare query sesuai nama kolom database
$stmt = $conn->prepare("
    INSERT INTO pks 
    (tanggal_pengiriman, nama_pks, tujuan_pengiriman, nomor_blanko_pb33, nopol_mobil, nama_supir, foto_keseluruhan_pks, foto_sebelum_pks, foto_sesudah_pks) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
");

if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]);
    exit;
}

// Bind parameter
$stmt->bind_param(
    "sssssssss",
    $tanggal,
    $nama_pks,
    $tujuan,
    $blanko,
    $nopol,
    $supir,
    $foto_keseluruhan,
    $foto_sebelum,
    $foto_sesudah
);

// Eksekusi
if ($stmt->execute()) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Data berhasil dikirim',
        'path_foto' => [
            'foto_keseluruhan' => $foto_keseluruhan,
            'foto_sebelum' => $foto_sebelum,
            'foto_sesudah' => $foto_sesudah
        ]
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal simpan data: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
