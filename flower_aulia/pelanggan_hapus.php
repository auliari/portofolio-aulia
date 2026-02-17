<?php
    include 'koneksi.php';
    $id = $_GET['id'];
    mysqli_query($koneksi, "delete from user where id = '$id'");

    echo "<script>alert('Data berhasil dihapus.');window.location='pelanggan.php';</script>";
?>