<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");

$koneksi = new mysqli('localhost', 'root', '', 'db_imunisasi');
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'];
$password = $data['password'];

// Cek admin
$queryAdmin = "SELECT * FROM users WHERE email='$email' AND password='$password' AND role='admin'";
$resultAdmin = mysqli_query($koneksi, $queryAdmin);

if (mysqli_num_rows($resultAdmin) > 0) {
    $admin = mysqli_fetch_assoc($resultAdmin);
    echo json_encode([
        "status" => "success",
        "role" => "admin",
        "data" => [
            "id" => intval($admin["id"]),
            "email" => $admin["email"],
            "nama" => $admin["nama"],   // ✅ tambahin nama
            "is_admin" => true
        ]
    ]);
    exit;
}

// Cek orang tua
$queryOrangtua = "SELECT * FROM users WHERE email='$email' AND password='$password' AND role='orang_tua'";
$resultOrangtua = mysqli_query($koneksi, $queryOrangtua);

if (mysqli_num_rows($resultOrangtua) > 0) {
    $orangtua = mysqli_fetch_assoc($resultOrangtua);
    echo json_encode([
        "status" => "success",
        "role" => "orang_tua",
        "data" => [
            "id" => intval($orangtua["id"]),
            "email" => $orangtua["email"],
            "nama" => $orangtua["nama"]   // ✅ tambahin nama
        ]
    ]);
    exit;
}

// Gagal login
echo json_encode([
    "status" => "error",
    "message" => "Login gagal. Email atau password salah."
]);
?>
