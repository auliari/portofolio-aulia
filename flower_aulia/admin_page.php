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

<div class = "container">
    <div class="alert alert-danger text-center" style="margin-left: -10px; width: 1150px; background-color: rgba(255, 51, 153,.05); color: black; ">
        <h4 style="margin-bottom: 0px"><b> 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flower2" viewBox="0 0 16 16">
                <path d="M8 16a4 4 0 0 0 4-4 4 4 0 0 0 0-8 4 4 0 0 0-8 0 4 4 0 1 0 0 8 4 4 0 0 0 4 4m3-12q0 .11-.03.247c-.544.241-1.091.638-1.598 1.084A3 3 0 0 0 8 5c-.494 0-.96.12-1.372.331-.507-.446-1.054-.843-1.597-1.084A1 1 0 0 1 5 4a3 3 0 0 1 6 0m-.812 6.052A3 3 0 0 0 11 8a3 3 0 0 0-.812-2.052c.215-.18.432-.346.647-.487C11.34 5.131 11.732 5 12 5a3 3 0 1 1 0 6c-.268 0-.66-.13-1.165-.461a7 7 0 0 1-.647-.487m-3.56.617a3 3 0 0 0 2.744 0c.507.446 1.054.842 1.598 1.084q.03.137.03.247a3 3 0 1 1-6 0q0-.11.03-.247c.544-.242 1.091-.638 1.598-1.084m-.816-4.721A3 3 0 0 0 5 8c0 .794.308 1.516.812 2.052a7 7 0 0 1-.647.487C4.66 10.869 4.268 11 4 11a3 3 0 0 1 0-6c.268 0 .66.13 1.165.461.215.141.432.306.647.487M8 9a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
            </svg>  
                Selamat Datang !</b> <span style="color: var(--pink);">di Sistem Toko Bunga Fleur d'Amour<span>  
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flower2" viewBox="0 0 16 16">
                <path d="M8 16a4 4 0 0 0 4-4 4 4 0 0 0 0-8 4 4 0 0 0-8 0 4 4 0 1 0 0 8 4 4 0 0 0 4 4m3-12q0 .11-.03.247c-.544.241-1.091.638-1.598 1.084A3 3 0 0 0 8 5c-.494 0-.96.12-1.372.331-.507-.446-1.054-.843-1.597-1.084A1 1 0 0 1 5 4a3 3 0 0 1 6 0m-.812 6.052A3 3 0 0 0 11 8a3 3 0 0 0-.812-2.052c.215-.18.432-.346.647-.487C11.34 5.131 11.732 5 12 5a3 3 0 1 1 0 6c-.268 0-.66-.13-1.165-.461a7 7 0 0 1-.647-.487m-3.56.617a3 3 0 0 0 2.744 0c.507.446 1.054.842 1.598 1.084q.03.137.03.247a3 3 0 1 1-6 0q0-.11.03-.247c.544-.242 1.091-.638 1.598-1.084m-.816-4.721A3 3 0 0 0 5 8c0 .794.308 1.516.812 2.052a7 7 0 0 1-.647.487C4.66 10.869 4.268 11 4 11a3 3 0 0 1 0-6c.268 0 .66.13 1.165.461.215.141.432.306.647.487M8 9a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
            </svg></h4>
</div>

<div class="container" style="margin-left: -23px; width: 1180px;">
<div class="panel">
<section class="dashboard">
    <h1 class="title"><b>dashboard</b></h1>

    <div class="box-container">
        <div class="box">
            <?php
                $total_pendings = 0;
                $select_pendings = mysqli_query($koneksi, "SELECT * FROM `transaksi` WHERE transaksi_status = '0'") or die('Query failed: ' . mysqli_error($koneksi));
                $number_of_pendings = mysqli_num_rows($select_pendings);
            ?>
            <h3><b><?php echo $number_of_pendings; ?></b></h3>
            <p>transaksi tertunda</p>
        </div>

        <div class="box">
            <?php
                $total_completes = 0;
                $select_completes = mysqli_query($koneksi, "SELECT * FROM `transaksi` WHERE transaksi_status = '1'") or die('Query failed: ' . mysqli_error($koneksi));
                $number_of_completes = mysqli_num_rows($select_completes);
            ?>
            <h3><b><?php echo $number_of_completes; ?></b></h3>
            <p>transaksi selesai</p>
        </div>

        <div class="box">
            <?php
                $select_orders = mysqli_query($koneksi, "SELECT * FROM `transaksi`") or die('Query failed: ' . mysqli_error($koneksi));
                $number_of_orders = mysqli_num_rows($select_orders);
            ?>
            <h3><b><?php echo $number_of_orders; ?></b></h3>
            <p>pesanan</p>
        </div>

        <div class="box">
            <?php
                $select_products = mysqli_query($koneksi, "select * from `produk`") or die('Query failed: ' . mysqli_error($koneksi));
                $number_of_products = mysqli_num_rows($select_products);
            ?>
            <h3><b><?php echo $number_of_products; ?></b></h3>
            <p>produk</p>
        </div>

        <div class="box">
            <?php
                $select_account = mysqli_query($koneksi, "select * from `user`") or die('query failed');
                $number_of_account = mysqli_num_rows($select_account);
            ?>
            <h3><b><?php echo $number_of_account; ?></b></h3>
            <p>total akun</p>
        </div>

        <div class="box">
         <?php
            $select_messages = mysqli_query($koneksi, "SELECT * FROM `pesan`") or die('query failed');
            $number_of_messages = mysqli_num_rows($select_messages);
         ?>
         <h3><b><?php echo $number_of_messages; ?></b></h3>
         <p>ulasan</p>
      </div>
    </div>

</section>
</div>
</div>
<br>
<div class="container" style="margin-left: -23px; width: 1180px;">
    <div class="panel">
        <div class="panel-heading">
        <h4 class="title"><b>Riwayat Transaksi Terakhir</b></h4>
        <div>
        <div class="panel-body">
            
            <table class="table table-bordered table-striped">
                <tr style="background-color: rgba(255, 51, 153,.05); color: var(--pink);">
                <th width="1%">No</th>
                    <th>Invoice</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Jumlah (Ikat)</th>
                    <th>Harga</th>
                    <th>Status</th>
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
                <br><br>
                <?php include 'footer.php';?>
</body>
</html>