<?php
include '../koneksi.php';

$id = isset($_GET['user_id']) ? $_GET['user_id'] : (isset($_GET['id']) ? $_GET['id'] : "");
$query = "DELETE FROM user WHERE user_id = $id";

if (mysqli_query($koneksi, $query)) {
    header("Location: daftar_pengguna.php");
} else {
    echo "Gagal menghapus data";
}
?>