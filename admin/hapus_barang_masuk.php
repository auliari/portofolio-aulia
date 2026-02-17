<?php
    include '../koneksi.php';
    $id = $_GET['bm_id'];
    mysqli_query($koneksi, "delete from barang_masuk where bm_id = '$id'");

    echo "<script>alert('Data berhasil dihapus.');window.location='barang_masuk.php';</script>";
?>