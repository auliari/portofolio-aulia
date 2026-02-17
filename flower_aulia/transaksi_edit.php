<?php
    include 'koneksi.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleur d'Amour</title>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/jquery.js"></script>
</head>
<body>
    <?php
    include 'header.php';?>
    <br>
<div class="container">
    <div class="panel">
        <center><div class="panel-heading"><h4><b>Edit Transaksi</b></h4></div></center>
        <div class="panel-body">
            <div class="col-md-8 col-md-offset-2">
                <a href="transaksi.php" class="btn btn-sm btn-info pull-right">Kembali</a>
                <br><br>

            <?php
                $id = $_GET['id'];
                $transaksi = mysqli_query($koneksi, "select * from transaksi where transaksi_id='$id'");
                while($t = mysqli_fetch_array($transaksi)){
            ?>
            <form action="transaksi_update.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $t['transaksi_id']; ?>">
                <div class="form-group">
                    <label>Pelanggan</label>
                    <select class="form-control" name="nama" required="required">
                        <option value="">- Pilih Pelanggan</option>
                        <?php
                            $data = mysqli_query($koneksi, "select*from user");
                            while($d = mysqli_fetch_array($data)){
                        ?>

                        <option <?php if ($d['id'] == $t['user_id']){
                            echo "selected = 'selected'";} ?>
                            value="<?php echo $d['id']; ?>">
                            <?php echo $d['nama']; ?>
                        </option>

                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Bunga Per Ikat</label>
                    <input type="number" name="jumlah" class="form-control" placeholder="Masukan jumlah bunga per ikat" required="required" value="<?php echo $t['jumlah'] ?>">
                </div>

                <div class="form-group">
                    <label>Tanggal Selesai</label>
                    <input type="date" name="transaksi_tgl" class="form-control" required="required" value="<?php echo $t['transaksi_tgl'] ?>">
                </div>

                <table class="table table-bordered table-striped">
                        <tr>
                            <th>Jenis Bunga</th>
                            <th width="20%">Jumlah</th>
                        </tr>

                        <?php
                            $transaksi_id = $t['transaksi_id'];
                            $bunga = mysqli_query($koneksi, "select * from bunga where transaksi_id ='$transaksi_id'");
                            while($b = mysqli_fetch_array($bunga)){
                        ?>
                        <tr>
                            <td><input type="text" class="form-control" name="bunga[]" value="<?php echo $b['bunga']; ?>"></td>
                            <td><input type="number" class="form-control" name="bunga_jumlah[]" value="<?php echo $b['bunga_jumlah']; ?>"></td>
                        </tr>
                        <?php
                            }
                        ?>

                        
                        <tr>
                            <td><input type="text" class="form-control" name="bunga[]"></td>
                            <td><input type="number" class="form-control" name="bunga_jumlah[]"></td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="bunga[]"></td>
                            <td><input type="number" class="form-control" name="bunga_jumlah[]"></td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="bunga[]"></td>
                            <td><input type="number" class="form-control" name="bunga_jumlah[]"></td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="bunga[]"></td>
                            <td><input type="number" class="form-control" name="bunga_jumlah[]"></td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="bunga[]"></td>
                            <td><input type="number" class="form-control" name="bunga_jumlah[]"></td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="bunga[]"></td>
                            <td><input type="number" class="form-control" name="bunga_jumlah[]"></td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="bunga[]"></td>
                            <td><input type="number" class="form-control" name="bunga_jumlah[]"></td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="bunga[]"></td>
                            <td><input type="number" class="form-control" name="bunga_jumlah[]"></td>
                        </tr>
                    </table>
                    <div class="form-group alert alert-info">
                        <label>Status</label>
                        <select class="form-control" name="status" required="required">
                            <option <?php if($t['transaksi_status']=="0"){echo "selected='selected'";}?> value="0">DITERIMA</option>
                            <option <?php if($t['transaksi_status']=="1"){echo "selected='selected'";}?> value="1">DIPROSES</option>
                            <option <?php if($t['transaksi_status']=="2"){echo "selected='selected'";}?> value="2">DIANTAR</option>
                            <option <?php if($t['transaksi_status']=="3"){echo "selected='selected'";}?> value="3">SELESAI</option>
                        </select>
                    </div>
                    <input type="submit" class="button" value="Simpan">
            </form>

            <?php
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>