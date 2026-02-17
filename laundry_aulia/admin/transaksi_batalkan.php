<?php
    include '../koneksi.php';
    $id = $_GET['id'];
    mysqli_query($koneksi, "delete from transaksi where transaksi_id = '$id'");

    mysqli_query($koneksi, "delete from pakaian where transaksi_id = '$id'");

    echo "<script>alert('Data berhasil dihapus.');window.location='transaksi.php';</script>";
?>