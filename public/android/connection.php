<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "rspo";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode([
        'status' => 'error',
        'message' => 'Koneksi gagal: ' . $conn->connect_error
    ]));
}
?>
