<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$conn = new mysqli("localhost", "root", "", "db_imunisasi");

// Cek koneksi
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Koneksi ke database gagal."]);
    exit();
}

$query = $conn->query("SELECT id, judul, deskripsi, tipe, url FROM konten ORDER BY id DESC");

$konten = [];
while ($row = $query->fetch_assoc()) {
    $konten[] = $row;
}

echo json_encode($konten);
?>