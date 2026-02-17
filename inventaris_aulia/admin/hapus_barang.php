<?php
include '../koneksi.php';

$id = $_GET['barang_id'];
$query = "DELETE FROM barang WHERE barang_id = $id";

if (mysqli_query($koneksi, $query)) {
    header("Location: data_barang.php");
} else {
    echo "Gagal menghapus data";
}
?>
