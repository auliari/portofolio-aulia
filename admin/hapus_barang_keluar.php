<?php
    include '../koneksi.php';
    $id = $_GET['bk_id'];
    mysqli_query($koneksi, "delete from barang_keluar where bk_id = '$id'");

    echo "<script>alert('Data berhasil dihapus.');window.location='barang_keluar.php';</script>";
?>