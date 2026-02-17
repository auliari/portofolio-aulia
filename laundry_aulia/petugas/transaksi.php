<?php
    include '../koneksi.php';
    include 'header.php';
?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4 style="color:#921A40;">Data Transaksi Laundry</h4>
        <div>
        <div class="panel-body">
            <a href="transaksi_tambah.php" class="btn btn-sm btn-info pull-right">Transaksi Baru</a>
            <br><br>
            <table class="table table-bordered table-striped">
            <tr style="background-color: rgba(255, 51, 51, 0.05); color: #921A40;">
                <th width="1%">No</th>
                    <th>Invoice</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Berat (Kg)</th>
                    <th>Tgl. Selesai</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th width="10%">OPSI</th>
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
                            <td>
                            <a href="transaksi_invoice.php?id=<?php echo $d['transaksi_id']; ?>" class="btn btn-sm btn-warning">Invoice</a>
                            </td>
                        </tr>
                    <?php
                    }
                ?>
            </table>
        </div>
        </div>
    </div>
</div>
                </div>
                </div>
<?php include 'footer.php' ?>