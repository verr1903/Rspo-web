<?php
header('Content-Type: application/json');
include 'connection.php'; // panggil file koneksi

$data = json_decode(file_get_contents("php://input"), true);
$login = trim($data['login'] ?? '');
$password = trim($data['password'] ?? '');

if (!$login || !$password) {
    echo json_encode(["status" => "error", "message" => "Login & password required"]);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM users WHERE username=? OR email=? LIMIT 1");
$stmt->bind_param("ss", $login, $login);
$stmt->execute();
// $result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    // cek hash password
    if (password_verify($password, $user['password'])) {
        echo json_encode(["status" => "success", "message" => "Login berhasil"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Password salah"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "User tidak ditemukan"]);
}
