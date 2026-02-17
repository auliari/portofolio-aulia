<?php
    include '../koneksi.php';
    include 'header.php';
?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4 style="color:#921A40;">Data Pelanggan</h4>
        <div>
        <div class="panel-body">
            <a href="pelanggan_tambah.php" class="btn btn-sm btn-info pull-right">Tambah</a>
            <br><br>
            <table class="table table-bordered table-striped">
            <tr style="background-color: rgba(255, 51, 51, 0.05); color: #921A40;">
                    <th width="1%">No</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                </tr>
                <?php
                    $data = mysqli_query($koneksi, "select * from pelanggan");
                    $no = 1;
                    while ($d= mysqli_fetch_array($data)) {
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $d['pelanggan_nama'] ?></td>
                    <td><?php echo $d['pelanggan_hp'] ?></td>
                    <td><?php echo $d['pelanggan_alamat'] ?></td>
                    
                </tr>
                <?php
                    }
                ?>
                </tr>
            </table>
        </div>
    </div>
</div>
                </div>
                </div>
<?php include 'footer.php' ?>