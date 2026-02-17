<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

$servername = "localhost";
$username = "root"; // sesuaikan
$password = ""; // sesuaikan
$dbname = "db_imunisasi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Koneksi gagal: " . $conn->connect_error]));
}

// Ambil method request
$method = $_SERVER['REQUEST_METHOD'];

// ---------------- GET DATA ----------------
if ($method === 'GET') {
    $result = $conn->query("SELECT * FROM master_jadwal ORDER BY tanggal_dijadwalkan ASC");
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
}

// ---------------- INSERT DATA ----------------
elseif ($method === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);
    if (!$input) {
        echo json_encode(["error" => "Data tidak valid"]);
        exit;
    }

    $nama = $conn->real_escape_string($input['nama_imunisasi']);
    $tanggal = $conn->real_escape_string($input['tanggal_dijadwalkan']);
    $lokasi = $conn->real_escape_string($input['lokasi']);

    $sql = "INSERT INTO master_jadwal (nama_imunisasi, tanggal_dijadwalkan, lokasi, dibuat_pada) 
            VALUES ('$nama', '$tanggal', '$lokasi', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Jadwal berhasil ditambahkan"]);
    } else {
        echo json_encode(["error" => "Error: " . $conn->error]);
    }
}

// ---------------- UPDATE DATA ----------------
elseif ($method === 'PUT') {
    if (!isset($_GET['id_master'])) {
        echo json_encode(["error" => "ID tidak ditemukan"]);
        exit;
    }

    $id = intval($_GET['id_master']);
    $input = json_decode(file_get_contents("php://input"), true);

    $nama = $conn->real_escape_string($input['nama_imunisasi']);
    $tanggal = $conn->real_escape_string($input['tanggal_dijadwalkan']);
    $lokasi = $conn->real_escape_string($input['lokasi']);

    $sql = "UPDATE master_jadwal 
            SET nama_imunisasi='$nama', tanggal_dijadwalkan='$tanggal', lokasi='$lokasi'
            WHERE id_master=$id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Jadwal berhasil diperbarui"]);
    } else {
        echo json_encode(["error" => "Error: " . $conn->error]);
    }
}

// ---------------- DELETE DATA ----------------
elseif ($method === 'DELETE') {
    if (!isset($_GET['id_master'])) {
        echo json_encode(["error" => "ID tidak ditemukan"]);
        exit;
    }

    $id = intval($_GET['id_master']);
    $sql = "DELETE FROM master_jadwal WHERE id_master=$id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Jadwal berhasil dihapus"]);
    } else {
        echo json_encode(["error" => "Error: " . $conn->error]);
    }
}

$conn->close();
