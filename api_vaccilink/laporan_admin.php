<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); // penting agar Flutter bisa akses

$conn = new mysqli("localhost", "root", "", "db_imunisasi");

// Cek koneksi
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Koneksi ke database gagal."]);
    exit();
}


$status = isset($_GET['status']) ? $_GET['status'] : '';
$dari   = isset($_GET['dari']) ? $_GET['dari'] : '';
$sampai = isset($_GET['sampai']) ? $_GET['sampai'] : '';

if (empty($status) || empty($dari) || empty($sampai)) {
    echo json_encode(["error" => "Parameter tidak lengkap"]);
    exit;
}

try {
    // gunakan prepared statement untuk keamanan
    $query = $conn->prepare("
    SELECT id_jadwal_anak, id_anak, status, tanggal_imunisasi, nomor_antrian
    FROM jadwal_anak
    WHERE status = ?
    AND tanggal_imunisasi BETWEEN ? AND ?
    ORDER BY tanggal_imunisasi ASC
");

    $query->bind_param("sss", $status, $dari, $sampai);
    $query->execute();
    $result = $query->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
