<?php
    include '../koneksi.php';

    $id = $_POST['id'];
    $pelanggan = $_POST['pelanggan'];
    $berat = $_POST['berat'];
    $tgl_selesai = $_POST['tgl_selesai'];
    $status = $_POST['status'];

    $h = mysqli_query($koneksi, "select harga_per_kilo from harga");
    $harga_per_kilo = mysqli_fetch_assoc($h);
    $harga = $berat * $harga_per_kilo['harga_per_kilo'];
    mysqli_query($koneksi, "update transaksi set pelanggan_id='$pelanggan', transaksi_harga='$harga', transaksi_berat='$berat', transaksi_tgl_selesai='$tgl_selesai', transaksi_Status='$status' where transaksi_id='$id'");

    $jenis_pakaian = $_POST['jenis_pakaian'];
    $jumlah_pakaian = $_POST['jumlah_pakaian'];
    mysqli_query($koneksi, "delete from pakaian where transaksi_id='$id'");
    for($x=0;$x<count($jenis_pakaian);$x++){
        if($jenis_pakaian[$x] != ""){
            mysqli_query($koneksi, "insert into pakaian values('','$id','$jenis_pakaian[$x]','$jumlah_pakaian[$x]')");
        }
    }

    echo "<script>alert('Data berhasil diedit.');window.location='transaksi.php';</script>";
?>