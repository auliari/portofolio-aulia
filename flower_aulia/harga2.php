<?php
    include 'koneksi.php';

    $harga = $_POST['harga'];

    mysqli_query($koneksi, "update harga set harga_per_ikat='$harga'");

    header("location:harga.php");
?>