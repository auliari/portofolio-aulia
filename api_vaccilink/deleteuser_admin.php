<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

$koneksi = new mysqli("localhost", "root", "", "db_imunisasi");

if ($koneksi->connect_error) {
    echo json_encode(["success" => false, "message" => "Koneksi gagal"]);
    exit();
}

if (!isset($_POST['id'])) {
    echo json_encode(["success" => false, "message" => "ID tidak ditemukan"]);
    exit();
}

$id = $koneksi->real_escape_string($_POST['id']);
$sql = "DELETE FROM users WHERE id='$id'";

if ($koneksi->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "User berhasil dihapus"]);
} else {
    echo json_encode(["success" => false, "message" => "Gagal hapus user: " . $koneksi->error]);
}
?>
