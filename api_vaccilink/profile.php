<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); 

$koneksi = new mysqli("localhost", "root", "", "db_imunisasi");

// Cek koneksi
if ($koneksi->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Koneksi ke database gagal."]);
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = $koneksi->query("SELECT id, nama, email, role FROM users WHERE id = $id");

    if ($query && $query->num_rows > 0) {
        $data = $query->fetch_assoc();
        echo json_encode($data);
    } else {
        echo json_encode(["error" => "User tidak ditemukan"]);
    }
} else {
    echo json_encode(["error" => "Parameter id diperlukan"]);
}
?>
