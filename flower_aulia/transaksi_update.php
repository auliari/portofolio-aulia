<?php
    include 'koneksi.php';

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jumlah = $_POST['jumlah'];
    $transaksi_tgl = $_POST['transaksi_tgl'];
    $status = $_POST['status'];

    $h = mysqli_query($koneksi, "select harga_per_ikat from harga");
    $harga_per_ikat = mysqli_fetch_assoc($h);
    $harga = $jumlah * $harga_per_ikat['harga_per_ikat'];
    mysqli_query($koneksi, "update transaksi set user_id='$nama', transaksi_harga='$harga', jumlah='$jumlah', transaksi_Status='$status' where transaksi_id='$id'");

    $bunga = $_POST['bunga'];
    $bunga_jumlah = $_POST['bunga_jumlah'];
    mysqli_query($koneksi, "delete from bunga where transaksi_id='$id'");
    for ($x = 0; $x < count($bunga); $x++) {
        if (!empty($bunga[$x]) && !empty($jumlah_bunga[$x])) {
            mysqli_query($koneksi, "INSERT INTO bunga (id, transaksi_id, bunga, bunga_jumlah) VALUES('', '$id', '$bunga[$x]', '$bunga_jumlah[$x]')");
        }
    }

    echo "<script>alert('Data berhasil diedit.');window.location='transaksi.php';</script>";
?>