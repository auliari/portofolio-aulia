<?php
    include 'koneksi.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleur d'Amour</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/jquery.js"></script>
</head>
<style>
@media print {
    .btn-cetak {
        display: none; /* Sembunyikan elemen dengan class "btn-cetak" saat mencetak */
    }
}
</style>
<body>
    <div class="container">
    <div class="panel">
        <div class="col-md-10 col-md-offset-1">
            <?php
            $id = $_GET['id'];
            $transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi, user WHERE transaksi_id='$id' AND transaksi.user_id = user.id");
            while($t=mysqli_fetch_array($transaksi)){
            ?>
            <br>
            <div class="alert alert-danger text" style="background-color: rgba(255, 51, 153,.05); color: black; ">
        <h4 class="title"><b>Toko Bunga Fleur d'Amour</b></h4>
        <button onclick="window.print()"class="btn btn-primary pull-right btn-cetak"><i class="glyphicon glyphicon-print"></i> CETAK</button>

            <br/>
            <br/>

            <table class="table">
                <tr>
                    <th width="20%">No. Invoice</th>
                    <th>:</th>
                    <td>Invoice-<?php echo $t['transaksi_id']; ?></td>
                </tr>
                <tr>
                    <th width="20%">Tgl. Pesan</th>
                    <th>:</th>
                    <td><?php echo $t['transaksi_tgl']; ?></td>
                </tr>
                <tr>
                    <th>Nama Pelanggan</th>
                    <th>:</th>
                    <td><?php echo $t['nama']; ?></td>
                </tr>   
                <tr>
                    <th>HP</th>
                    <th>:</th>
                    <td><?php echo $t['no_hp']; ?></td>
                </tr>   
                <tr>
                    <th>Alamat</th>
                    <th>:</th>
                    <td><?php echo $t['alamat']; ?></td>
                </tr>   
                <tr>
                    <th>Bunga Per Ikat</th>
                    <th>:</th>
                    <td><?php echo $t['jumlah']; ?></td>
                </tr>
                
                <tr>
                    <th>Status</th>
                    <th>:</th>
                    <td>
                        <?php
                            if($t['transaksi_status']=="0"){
                                echo "<div class='label label-warning'>DITERIMA</div>";
                            }else if ($t['transaksi_status']=="1"){
                                echo "<div class='label label-info'>DIPROSES</div>";
                            }else if($t['transaksi_status']=="2"){
                                echo "<div class='label label-danger'>DIANTAR</div>";
                            }else if($t['transaksi_status']=="3"){
                                echo "<div class='label label-success'>SELESAI</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <th>:</th>
                    <td><?php echo "Rp. ".number_format($t['transaksi_harga'])." ,-"; ?></td>
                </tr>
            </table>

            <br/>

            <h4 class="text-center">Daftar Bunga</h4>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Bunga</th>
                    <th width="20%">Jumlah</th>
                </tr>

                <?php
                $id = $t['transaksi_id'];
                $bunga = mysqli_query($koneksi,"select * from bunga where transaksi_id='$id'");
                while($p=mysqli_fetch_array($bunga)){
                ?>
                <tr>
                    <td><?php echo $p['bunga']; ?></td>
                    <td width="5%"><?php echo $p['bunga_jumlah']; ?></td>
                </tr>
                <?php } ?>
                </table>
                <br>
                <p><center><i><b>"Terima kasih telah memilih bunga kami untuk menyempurnakan hari Anda."</b></i></center></p>
            <?php
            }
            ?>
            </div>
</div>
        </div>
</body>
</html>