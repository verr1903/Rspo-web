<?php
header('Content-Type: application/json');

include 'connection.php'; // koneksi DB

// Ambil data dari form-data
$tanggal = $_POST['tanggal'] ?? '';
$nama_kebun = $_POST['nama_kebun'] ?? '';
$afdeling = $_POST['afdeling'] ?? '';
$blanko = $_POST['blanko'] ?? '';
$nopol = $_POST['nopol'] ?? '';
$supir = $_POST['supir'] ?? '';

// Fungsi upload file
function uploadFile($file, $folder = 'kebun/')
{
    if (isset($file) && $file['error'] == 0) {
        // Path ke storage/app/public/kebun/
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
$foto_sebelum     = uploadFile($_FILES['foto2'] ?? null);
$foto_sesudah     = uploadFile($_FILES['foto3'] ?? null);

// Insert ke tabel kebuns
$stmt = $conn->prepare("
    INSERT INTO kebuns 
    (
        tanggal_pengiriman, 
        nama_kebun,  
        afdeling, 
        nomor_blanko_pb25, 
        nopol_mobil, 
        nama_supir, 
        foto_keseluruhan_kebun, 
        foto_sebelum_kebun, 
        foto_sesudah_kebun
    ) 
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
    $nama_kebun,
    $afdeling,
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
