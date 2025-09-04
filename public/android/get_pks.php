<?php
header('Content-Type: application/json');

include 'connection.php'; // panggil file koneksi

$result = $conn->query("SELECT id, nama_pks FROM list_pks ORDER BY nama_pks ASC");

$pks = [];
while ($row = $result->fetch_assoc()) {
    $pks[] = $row;
}

echo json_encode([
    "status" => "success",
    "data" => $pks
]);
?>
