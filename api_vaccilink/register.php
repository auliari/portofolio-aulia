<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");

$koneksi = new mysqli('localhost', 'root', '', 'db_imunisasi');
if ($koneksi->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "Koneksi gagal: " . $koneksi->connect_error
    ]));
}

$data = json_decode(file_get_contents("php://input"), true);
$nama = isset($data['nama']) ? $data['nama'] : '';
$email = isset($data['email']) ? $data['email'] : '';
$password = isset($data['password']) ? $data['password'] : '';

if (empty($nama) || empty($email) || empty($password)) {
    echo json_encode([
        "status" => "error",
        "message" => "Semua field harus diisi."
    ]);
    exit;
}

// Cek apakah email sudah terdaftar
$cekEmail = $koneksi->prepare("SELECT * FROM users WHERE email=?");
$cekEmail->bind_param("s", $email);
$cekEmail->execute();
$hasil = $cekEmail->get_result();

if ($hasil->num_rows > 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Email sudah terdaftar."
    ]);
    exit;
}

// Simpan data sebagai pembeli
$role = 'orang_tua';
$query = $koneksi->prepare("INSERT INTO users (nama, email, password, role) VALUES (?, ?, ?, ?)");
$query->bind_param("ssss", $nama, $email, $password, $role);

if ($query->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Registrasi berhasil.",
        "data" => [
            "id" => $query->insert_id,
            "nama" => $nama,
            "email" => $email,
            "password" => $password,
            "role" => $role
        ]
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Registrasi gagal: " . $query->error
    ]);
}
?>