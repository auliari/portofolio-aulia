<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

$koneksi = new mysqli("localhost", "root", "", "db_imunisasi");

if ($koneksi->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Koneksi ke database gagal: " . $koneksi->connect_error]);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];
$nama = $data['nama'];
$email = $data['email'];
$role = $data['role'];
$password = isset($data['password']) ? $data['password'] : null;

if (!empty($password)) {
    // Update dengan password baru
    $query = "UPDATE user SET nama='$nama', email='$email', password='$password', role='$role' WHERE id='$id'";
} else {
    // Update tanpa ubah password
    $query = "UPDATE user SET nama='$nama', email='$email', role='$role' WHERE id='$id'";
}

if (mysqli_query($koneksi, $query)) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => mysqli_error($koneksi)]);
}
?>
