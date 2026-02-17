<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$conn = new mysqli("localhost", "root", "", "db_imunisasi");

// Cek koneksi
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Koneksi ke database gagal."]);
    exit();
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // Ambil semua jadwal anak
    $sql = "SELECT j.id_jadwal_anak, j.id_master, j.id_anak, 
                   a.nama_anak, j.status, j.tanggal_imunisasi, j.nomor_antrian
            FROM jadwal_anak j
            JOIN anak a ON j.id_anak = a.id_anak
            ORDER BY j.tanggal_imunisasi ASC";

    $result = mysqli_query($conn, $sql);
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    echo json_encode($data);
}

elseif ($method === 'POST') {
    $id_jadwal = $_POST['id_jadwal_anak'] ?? '';
    $status = $_POST['status'] ?? '';
    $tanggal = $_POST['tanggal_imunisasi'] ?? '';
    $nomor = $_POST['nomor_antrian'] ?? '';

    if ($id_jadwal == '') {
        echo json_encode(["success" => false, "message" => "ID jadwal kosong"]);
        exit;
    }

    // Build query dinamis
    $fields = [];
    if ($status != '') $fields[] = "status='$status'";
    if ($tanggal != '') $fields[] = "tanggal_imunisasi='$tanggal'";
    if ($nomor != '') $fields[] = "nomor_antrian='$nomor'";

    if (count($fields) > 0) {
        $query = "UPDATE jadwal_anak SET " . implode(", ", $fields) . " WHERE id_jadwal_anak='$id_jadwal'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo json_encode(["success" => true, "message" => "Data berhasil diupdate"]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal update"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Tidak ada data untuk update"]);
    }
}
else {
    echo json_encode(["success" => false, "message" => "Metode tidak didukung"]);
}
?>
