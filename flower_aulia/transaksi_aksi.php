<?php
include 'koneksi.php';
    $nama = $_POST['nama'];
    $jumlah = $_POST['jumlah'];
    $transaksi_tgl = $_POST['transaksi_tgl'];

    $status = 1;
    $h = mysqli_query($koneksi, "select harga_per_ikat from harga");
    $harga_per_ikat = mysqli_fetch_assoc($h);
    $harga = $jumlah * $harga_per_ikat['harga_per_ikat'];
    mysqli_query($koneksi, "INSERT INTO transaksi(transaksi_tgl, user_id, jumlah, transaksi_harga, transaksi_status) VALUES('$transaksi_tgl', '$nama', '$jumlah', '$harga', '$status')");
    $id_terakhir = mysqli_insert_id($koneksi);
    $bunga = $_POST['bunga'];
    $bunga_jumlah = $_POST['bunga_jumlah'];
    for($x=0;$x<count($bunga);$x++){
        if($bunga[$x] != ""){
            mysqli_query($koneksi, "insert into bunga values('','$id_terakhir','$bunga[$x]','$bunga_jumlah[$x]')");
        }
    }
    echo "<script>alert('Data berhasil ditambah.');window.location='transaksi.php';</script>";
?>