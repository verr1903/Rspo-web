<?php
header('Content-Type: application/json');

include 'connection.php'; // panggil file koneksi

$result = $conn->query("SELECT id, afdeling FROM list_afdelings ORDER BY afdeling ASC");

$afdeling = [];
while ($row = $result->fetch_assoc()) {
    $afdeling[] = $row;
}

echo json_encode([
    "status" => "success",
    "data" => $afdeling
]);
?>
