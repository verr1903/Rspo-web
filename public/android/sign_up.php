<?php
header('Content-Type: application/json');

include 'connection.php'; // panggil file koneksi

// Ambil data POST JSON atau form
$data = json_decode(file_get_contents("php://input"), true);
$username = trim($data['username'] ?? $_POST['username'] ?? '');
$email = trim($data['email'] ?? $_POST['email'] ?? '');
$password = trim($data['password'] ?? $_POST['password'] ?? '');
$confirm_password = trim($data['confirm_password'] ?? $_POST['confirm_password'] ?? '');

// Validasi input
if (!$username || !$email || !$password || !$confirm_password) {
    echo json_encode(["status" => "error", "message" => "Semua field harus diisi"]);
    exit;
}

if ($password !== $confirm_password) {
    echo json_encode(["status" => "error", "message" => "Password dan konfirmasi password tidak sama"]);
    exit;
}

// Cek apakah username atau email sudah dipakai
$stmt = $conn->prepare("SELECT * FROM users WHERE username=? OR email=? LIMIT 1");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->fetch_assoc()) {
    echo json_encode(["status" => "error", "message" => "Username atau email sudah digunakan"]);
    exit;
}

// Hash password sebelum simpan
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Masukkan user baru ke database
$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hashedPassword);
if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Registrasi berhasil"]);
} else {
    echo json_encode(["status" => "error", "message" => "Gagal registrasi: " . $stmt->error]);
}
?>
