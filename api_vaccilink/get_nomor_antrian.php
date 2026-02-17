<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$conn = new mysqli("localhost", "root", "", "db_imunisasi");

if (!isset($_GET['id'])) {
    echo json_encode(["success" => false, "message" => "ID user tidak ditemukan"]);
    exit;
}

$id_orangtua = $_GET['id'];

// ambil nomor antrian terbaru untuk anak user ini
$query = "
    SELECT ja.nomor_antrian, ja.tanggal_imunisasi, a.nama_anak
    FROM jadwal_anak ja
    JOIN anak a ON ja.id_anak = a.id_anak
    WHERE a.id_orangtua = '$id_orangtua'
    ORDER BY ja.tanggal_imunisasi DESC, ja.id_jadwal_anak DESC
    LIMIT 1
";

$result = mysqli_query($koneksi, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    echo json_encode([
        "success" => true,
        "nomor_antrian" => $data['nomor_antrian'],
        "tanggal" => $data['tanggal_imunisasi'],
        "nama_anak" => $data['nama_anak']
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Belum ada antrian"
    ]);
}
?>
