<?php
include 'header.php';
?>

<div class="container">
    <br><br><br>
    <div class="col-md-5 col-md-offset-3">
        <div class="panel">
            <div class="panel-heading">
                <h4><b>Pengaturan Harga Bunga</b></h4>
            </div>
            <div class="panel-body">
                <?php
                include 'koneksi.php';
                $data = mysqli_query($koneksi, "SELECT harga_per_ikat FROM harga LIMIT 1");
                $d = mysqli_fetch_array($data);
                ?>
                <form method="post" action="harga2.php">
                    <div class="form-group">
                        <label>Harga per ikat</label>
                        <input type="number" class="form-control" name="harga" value="<?php echo $d['harga_per_ikat']; ?>">
                    </div>
                    <input type="submit" class="button" value="Ubah Harga">
                </form>
            </div>
        </div>
    </div>
</div>
