<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); 

$koneksi = new mysqli("localhost", "root", "", "db_imunisasi");

// Cek koneksi
if ($koneksi->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Koneksi ke database gagal."]);
    exit();
}

$nama = $_POST['nama'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? 'orang_tua';

if ($nama && $email && $password && $role) {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $query = $koneksi->prepare("INSERT INTO users (nama, email, password, role) VALUES (?, ?, ?, ?)");
    $query->bind_param("ssss", $nama, $email, $passwordHash, $role);

    if ($query->execute()) {
        echo json_encode(["success" => true, "message" => "User berhasil ditambahkan"]);
    } else {
        echo json_encode(["success" => false, "message" => "Gagal menambahkan user: " . $query->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Data tidak lengkap"]);
}
?>
