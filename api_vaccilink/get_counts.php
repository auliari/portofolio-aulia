<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

$conn = new mysqli("localhost", "root", "", "db_imunisasi");

if ($conn->connect_error) {
    echo json_encode(["error" => "Koneksi gagal"]);
    exit();
}

$response = [];

// Hitung total anak
$q_anak = mysqli_query($conn, "SELECT COUNT(*) as total FROM anak");
if ($q_anak) {
    $response['total_anak'] = mysqli_fetch_assoc($q_anak)['total'];
} else {
    $response['total_anak'] = 0;
    $response['error_anak'] = $conn->error;
}

// Hitung total orang tua
$q_ortu = mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE role = 'orang_tua'");
if ($q_ortu) {
    $response['total_ortu'] = mysqli_fetch_assoc($q_ortu)['total'];
} else {
    $response['total_ortu'] = 0;
    $response['error_ortu'] = $conn->error;
}

// Hitung total jadwal
$q_jadwal = mysqli_query($conn, "SELECT COUNT(*) as total FROM master_jadwal");
if ($q_jadwal) {
    $response['total_jadwal'] = mysqli_fetch_assoc($q_jadwal)['total'];
} else {
    $response['total_jadwal'] = 0;
    $response['error_jadwal'] = $conn->error;
}

// Hitung perlu verifikasi
$q_verif = mysqli_query($conn, "SELECT COUNT(*) as total FROM jadwal_anak WHERE status = 'belum'");
if ($q_verif) {
    $response['perlu_verifikasi'] = mysqli_fetch_assoc($q_verif)['total'];
} else {
    $response['perlu_verifikasi'] = 0;
    $response['error_verif'] = $conn->error;
}

echo json_encode($response);
?>
