<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$conn = new mysqli("localhost", "root", "", "db_imunisasi");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aksi = $_POST['aksi'] ?? '';

    if ($aksi === "get_anak") {
        $id_orangtua = $_POST['id_orangtua'] ?? '';
        if (empty($id_orangtua)) {
            echo json_encode(["success" => false, "message" => "id_orangtua kosong"]);
            exit;
        }

        $result = $conn->query("SELECT * FROM anak WHERE id_orangtua = '$id_orangtua'");
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode(["success" => true, "data" => $data]);
    }

    elseif ($aksi === "add_anak") {
        $id_orangtua = $_POST['id_orangtua'] ?? '';
        $nik = $_POST['nik_anak'] ?? '';
        $nama = $_POST['nama_anak'] ?? '';
        $tgl = $_POST['tanggal_lahir'] ?? '';
        $jk = $_POST['jenis_kelamin'] ?? '';
        $gol = $_POST['golongan_darah'] ?? '';
        $berat = $_POST['berat_lahir'] ?? '';
        $tinggi = $_POST['tinggi_lahir'] ?? '';

        if (empty($id_orangtua) || empty($nik) || empty($nama)) {
            echo json_encode(["success" => false, "message" => "Data wajib diisi"]);
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO anak (id_orangtua, nik_anak, nama_anak, tanggal_lahir, jenis_kelamin, golongan_darah, berat_lahir, tinggi_lahir) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssss", $id_orangtua, $nik, $nama, $tgl, $jk, $gol, $berat, $tinggi);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Data anak berhasil ditambahkan"]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal tambah data"]);
        }
    }
} else {
    echo json_encode(["success" => false, "message" => "Metode tidak diizinkan"]);
}
