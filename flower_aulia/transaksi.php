<?php
    include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleur d'Amour</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/jquery.js"></script>
</head>
<body>
   
<?php
    include 'header.php';
?>
<br>
<div class="container" style="margin-left: 167px; width: 1180px;">
    <div class="panel">
        <div class="panel-heading">
        <h4 class="title"><b>Data <span>Transaksi</span></b></h4>
        <div class="panel-body">
            <a href="transaksi_tambah.php" class="button">Transaksi Tambah</a>
            <br><br>
            <table class="table table-bordered table-striped">
                <tr style="background-color: rgba(255, 51, 153,.05); color: var(--pink);">
                <th width="1%">No</th>
                    <th>Invoice</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Jumlah (Ikat)</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th width="20%">OPSI</th>
                </tr>
                <?php
                    $data = mysqli_query($koneksi, "SELECT * from 
                    user,transaksi where user.id = 
                    transaksi.user_id order by transaksi_id desc limit 7");
                    $no = 1;
                    while ($d= mysqli_fetch_array($data)) {
                    ?>
                       <tr>
                           <td><?php echo $no++ ?></td>
                           <td>INVOICE-<?php echo $d['transaksi_id'] ?></td>
                           <td><?php echo $d['transaksi_tgl'] ?></td>
                           <td><?php echo $d['nama'] ?></td>
                           <td><?php echo $d['jumlah'] ?></td>
                           <td><?php echo "Rp. ".number_format($d['transaksi_harga']).",-" ?></td>
                           <td>
                            <?php
                            if($d['transaksi_status']=="0"){
                                echo "<div class='label label-warning'>DITERIMA</div>";
                            }else if ($d['transaksi_status']=="1")
                            {
                                echo "<div class='label label-info'>DIPROSES</div>";
                            }else if($d['transaksi_status']=="2")
                            {
                                echo "<div class='label label-danger'>DIANTAR</div>";
                            }else if($d['transaksi_status']=="3")
                            {
                                echo "<div class='label label-success'>SELESAI</div>";
                            }
                            ?>
                            <td>
                            <a href="transaksi_invoice.php?id=<?php echo $d['transaksi_id']; ?>" class="btn btn-sm btn-warning">Invoice</a>
                            <a href="transaksi_edit.php?id=<?php echo $d['transaksi_id']; ?>" class="btn btn-sm btn-info">Edit</a>
                            <a href="transaksi_batalkan.php?id=<?php echo $d['transaksi_id']; ?>" class="btn btn-sm btn-danger">Batalkan</a>
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
                <br>
                <?php include 'footer.php';?>
 
</body>
</html>