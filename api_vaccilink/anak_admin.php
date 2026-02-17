<?php
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

$method = $_SERVER['REQUEST_METHOD'];

// ✅ GET -> ambil semua data anak
if ($method == 'GET') {
    $result = $conn->query("SELECT * FROM anak ORDER BY id_anak DESC");
    $anak = [];
    while ($row = $result->fetch_assoc()) {
        $anak[] = $row;
    }
    echo json_encode($anak);
}

// ✅ POST -> tambah data anak
elseif ($method == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        echo json_encode(["error" => "No input data"]);
        exit;
    }

    $id_orangtua   = $conn->real_escape_string($data['id_orangtua']);
    $nik_anak      = $conn->real_escape_string($data['nik_anak']);
    $nama_anak     = $conn->real_escape_string($data['nama_anak']);
    $tanggal_lahir = $conn->real_escape_string($data['tanggal_lahir']);
    $jenis_kelamin = $conn->real_escape_string($data['jenis_kelamin']);
    $golongan_darah= $conn->real_escape_string($data['golongan_darah']);
    $berat_lahir   = $conn->real_escape_string($data['berat_lahir']);
    $tinggi_lahir  = $conn->real_escape_string($data['tinggi_lahir']);

    $sql = "INSERT INTO anak (id_orangtua, nik_anak, nama_anak, tanggal_lahir, jenis_kelamin, golongan_darah, berat_lahir, tinggi_lahir)
            VALUES ('$id_orangtua', '$nik_anak', '$nama_anak', '$tanggal_lahir', '$jenis_kelamin', '$golongan_darah', '$berat_lahir', '$tinggi_lahir')";

    if ($conn->query($sql)) {
        echo json_encode(["success" => true, "message" => "Data anak berhasil ditambahkan"]);
    } else {
        echo json_encode(["success" => false, "error" => $conn->error]);
    }
}

// ✅ PUT -> update data anak
elseif ($method == 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    $id_anak = $conn->real_escape_string($data['id_anak']);

    $id_orangtua   = $conn->real_escape_string($data['id_orangtua']);
    $nik_anak      = $conn->real_escape_string($data['nik_anak']);
    $nama_anak     = $conn->real_escape_string($data['nama_anak']);
    $tanggal_lahir = $conn->real_escape_string($data['tanggal_lahir']);
    $jenis_kelamin = $conn->real_escape_string($data['jenis_kelamin']);
    $golongan_darah= $conn->real_escape_string($data['golongan_darah']);
    $berat_lahir   = $conn->real_escape_string($data['berat_lahir']);
    $tinggi_lahir  = $conn->real_escape_string($data['tinggi_lahir']);

    $sql = "UPDATE anak SET 
                id_orangtua='$id_orangtua',
                nik_anak='$nik_anak',
                nama_anak='$nama_anak',
                tanggal_lahir='$tanggal_lahir',
                jenis_kelamin='$jenis_kelamin',
                golongan_darah='$golongan_darah',
                berat_lahir='$berat_lahir',
                tinggi_lahir='$tinggi_lahir'
            WHERE id_anak='$id_anak'";

    if ($conn->query($sql)) {
        echo json_encode(["success" => true, "message" => "Data anak berhasil diupdate"]);
    } else {
        echo json_encode(["success" => false, "error" => $conn->error]);
    }
}

// ✅ DELETE -> hapus data anak
elseif ($method == 'DELETE') {
    parse_str(file_get_contents("php://input"), $data);
    $id_anak = $conn->real_escape_string($data['id_anak']);

    $sql = "DELETE FROM anak WHERE id_anak='$id_anak'";
    if ($conn->query($sql)) {
        echo json_encode(["success" => true, "message" => "Data anak berhasil dihapus"]);
    } else {
        echo json_encode(["success" => false, "error" => $conn->error]);
    }
}

$conn->close();
?>
