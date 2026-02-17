<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$conn = new mysqli("localhost", "root", "", "db_imunisasi");

// Cek koneksi
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["success" => false, "error" => "Koneksi ke database gagal."]);
    exit();
}

// Tangani request OPTIONS (CORS preflight)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// 🔹 Hybrid mode: kalau GET, treat sama kayak POST
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $_POST = $_GET;
}

// Pastikan aksi ada
if (!isset($_POST['aksi'])) {
    echo json_encode([
        "success" => false,
        "error" => "Aksi tidak ditentukan",
        "received" => $_POST
    ]);
    exit();
}

$aksi = $_POST['aksi'];

if ($aksi == "get_riwayat_anak") {
    if (!isset($_POST['id_anak'])) {
        echo json_encode(["success" => false, "error" => "ID anak tidak ditemukan"]);
        exit();
    }
    
    $id_anak = $conn->real_escape_string($_POST['id_anak']);

    $sql = "SELECT ja.*, mj.nama_imunisasi, mj.lokasi 
            FROM jadwal_anak ja
            JOIN master_jadwal mj ON ja.id_master = mj.id_master
            WHERE ja.id_anak = '$id_anak' AND ja.status = 'sudah'
            ORDER BY ja.tanggal_imunisasi DESC";

    $result = mysqli_query($conn, $sql);
    
    if (!$result) {
        echo json_encode([
            "success" => false, 
            "error" => "Query gagal: " . mysqli_error($conn),
            "sql" => $sql
        ]);
        exit();
    }
    
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    echo json_encode([
        "success" => true,
        "count" => count($data),
        "data" => $data,
        "sql" => $sql,
        "received" => $_POST
    ]);
} else {
    echo json_encode(["success" => false, "error" => "Aksi tidak valid"]);
}

$conn->close();
?>