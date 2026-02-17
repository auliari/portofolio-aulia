<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); // penting agar Flutter bisa akses

$conn = new mysqli("localhost", "root", "", "db_imunisasi");

// Cek koneksi
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Koneksi ke database gagal."]);
    exit();
}

$id = $_POST['id'];
$oldPassword = $_POST['old_password'];
$newPassword = $_POST['new_password'];

// ambil data user
$query = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
$user = mysqli_fetch_assoc($query);

if ($user) {
    // kalau password lama cocok (sementara plain text, bisa diganti password_verify kalau hash)
    if ($user['password'] === $oldPassword) {
        // update password baru
        mysqli_query($conn, "UPDATE users SET password='$newPassword' WHERE id='$id'");
        echo json_encode(["success" => true, "message" => "Password berhasil diubah"]);
    } else {
        echo json_encode(["success" => false, "message" => "Password lama salah"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "User tidak ditemukan"]);
}
?>
