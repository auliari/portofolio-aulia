<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$conn = new mysqli("localhost", "root", "", "db_imunisasi");

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Koneksi ke database gagal."]);
    exit();
}

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_anak = $_POST['id_anak'] ?? '';
    $nama_anak = $_POST['nama_anak'] ?? '';
    $nik_anak = $_POST['nik_anak'] ?? '';
    $tanggal_lahir = $_POST['tanggal_lahir'] ?? '';
    $jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
    $golongan_darah = $_POST['golongan_darah'] ?? '';
    $berat_lahir = $_POST['berat_lahir'] ?? '';
    $tinggi_lahir = $_POST['tinggi_lahir'] ?? '';

    if (!empty($id_anak) && !empty($nama_anak) && !empty($nik_anak)) {
        $stmt = $conn->prepare("UPDATE anak SET nama_anak=?, nik_anak=?, tanggal_lahir=?, jenis_kelamin=?, golongan_darah=?, berat_lahir=?, tinggi_lahir=? WHERE id_anak=?");
        $stmt->bind_param("sssssdds", $nama_anak, $nik_anak, $tanggal_lahir, $jenis_kelamin, $golongan_darah, $berat_lahir, $tinggi_lahir, $id_anak);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "Data anak berhasil diperbarui";
            $response['nama_anak'] = $nama_anak;
        } else {
            $response['success'] = false;
            $response['message'] = "Gagal memperbarui data: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $response['success'] = false;
        $response['message'] = "Data tidak lengkap";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Metode request tidak valid";
}

echo json_encode($response);
$conn->close();
?>