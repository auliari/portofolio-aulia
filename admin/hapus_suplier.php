<?php
include '../koneksi.php';

$id = $_GET['suplier_id'];
$query = "DELETE FROM suplier WHERE suplier_id = $id";

if (mysqli_query($koneksi, $query)) {
    header("Location: data_suplier.php");
} else {
    echo "Gagal menghapus data";
}
?>