<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

$conn = new mysqli("localhost", "root", "", "db_imunisasi");

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Koneksi ke database gagal."]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_anak = $_POST['id_anak'];
    $nama = $_POST['nama_anak'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $golongan_darah = $_POST['golongan_darah'];
    $berat_lahir = $_POST['berat_lahir'];
    $tinggi_lahir = $_POST['tinggi_lahir'];

    $query = "UPDATE anak SET 
                nama_anak='$nama', 
                tanggal_lahir='$tanggal_lahir', 
                jenis_kelamin='$jenis_kelamin',
                golongan_darah='$golongan_darah',
                berat_lahir='$berat_lahir',
                tinggi_lahir='$tinggi_lahir'
              WHERE id_anak='$id_anak'";

    if (mysqli_query($conn, $query)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => mysqli_error($conn)]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
?>