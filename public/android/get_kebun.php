<?php
header('Content-Type: application/json');

include 'connection.php'; // panggil file koneksi

$result = $conn->query("SELECT id, nama_kebun FROM list_kebuns ORDER BY nama_kebun ASC");

$kebun = [];
while ($row = $result->fetch_assoc()) {
    $kebun[] = $row;
}

echo json_encode([
    "status" => "success",
    "data" => $kebun
]);
?>
