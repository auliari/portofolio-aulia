<?php
 include "../koneksi.php";
 include "header.php";
?>

<div class = "container">
    <div class="alert alert-danger" role="alert">
        <h4 style="margin-bottom: 0px"><center><b>Selamat Datang !</b> di 
        Sistem Informasi Laundry</center></h4>
</div>
    <div class="panel">
        <div class="panel-heading">
            <h4 style="color:#921A40;">Dashboard</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-user"></i>
                                <span class="pull-right">
                                    <?php
                                    $pelanggan = mysqli_query($koneksi, "select * from pelanggan");
                                    echo mysqli_num_rows($pelanggan);
                                    ?>
                                </span>
                            </h1>
                            Jumlah Pelanggan
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-retweet"></i>
                                <span class="pull-right">
                                    <?php
                                    $proses = mysqli_query($koneksi, "select * from transaksi where transaksi_status = '0'");
                                    echo mysqli_num_rows($proses);
                                    ?>
                                </span>
                            </h1>
                            Jumlah Cucian Diproses
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-info-sign"></i>
                                <span class="pull-right">
                                    <?php
                                    $proses = mysqli_query($koneksi, "select * from transaksi where transaksi_status = '1'");
                                    echo mysqli_num_rows($proses);
                                    ?>
                                </span>
                            </h1>
                            Jumlah Cucian Siap Diantar
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-ok-circle"></i>
                                <span class="pull-right">
                                    <?php
                                    $proses = mysqli_query($koneksi, "select * from transaksi where transaksi_status = '2'");
                                    echo mysqli_num_rows($proses);
                                    ?>
                                </span>
                            </h1>
                            Jumlah Cucian Selesai
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="panel">
        <div class="panel-heading">
            <h4 style="color:#921A40;">Riwayat Transaksi Terakhir</h4>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
            <tr style="background-color: rgba(255, 51, 51, 0.05); color: #921A40;">
                    <th width="1%">No</th>
                    <th>Invoice</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Berat (Kg)</th>
                    <th>Tanggal Selesai</th>
                    <th>Harga</th>
                    <th>Status</th>
                </tr>
                <?php
                    $data = mysqli_query($koneksi, "select * from 
                    pelanggan,transaksi where pelanggan.pelanggan_id = 
                    transaksi.pelanggan_id order by transaksi_id desc limit 7");
                    $no = 1;
                    while ($d= mysqli_fetch_array($data)) {
                    ?>
                       <tr>
                           <td><?php echo $no++ ?></td>
                           <td>INVOICE-<?php echo $d['transaksi_id'] ?></td>
                           <td><?php echo $d['transaksi_tgl'] ?></td>
                           <td><?php echo $d['pelanggan_nama'] ?></td>
                           <td><?php echo $d['transaksi_berat'] ?></td>
                           <td><?php echo $d['transaksi_tgl_selesai'] ?></td>
                           <td><?php echo "Rp. ".number_format($d['transaksi_harga']).",-" ?></td>
                           <td>
                            <?php
                            if($d['transaksi_status']=="0"){
                                echo "<div class='label label-warning'>PROSES</div>";
                            }else if ($d['transaksi_status']=="1")
                            {
                                echo "<div class='label label-info'>DICUCI</div>";
                            }else if($d['transaksi_status']=="2")
                            {
                                echo "<div class='label label-success'>SELESAI</div>";
                            }
                            ?>
                           </tr>
                    <?php
                    }
                ?>
            </table>
        </div>

    </div>
</div>

<?php include 'footer.php' ?>