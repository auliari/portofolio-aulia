<?php
    include "../koneksi.php";

    $nama = $_POST['name'];
    $hp = $_POST['hp'];
    $alamat = $_POST['alamat'];

    mysqli_query($koneksi, "insert into pelanggan value('','$nama','$hp','$alamat')");

    echo "<script>alert('Data berhasil ditambah.');window.location='pelanggan.php';</script>";
?>