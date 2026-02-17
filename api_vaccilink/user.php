<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$koneksi = new mysqli("localhost", "root", "", "db_imunisasi");

// Cek koneksi
if ($koneksi->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Koneksi ke database gagal: " . $koneksi->connect_error]);
    exit();
}

// Query ke tabel users
$sql = "SELECT id, nama, email, role FROM users";
$result = $koneksi->query($sql);

$data = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Gagal menjalankan query: " . $koneksi->error]);
}
?>
