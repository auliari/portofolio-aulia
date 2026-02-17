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
    include 'header.php';
?> 
<br>
<div class="container">
    <div class="panel">
        <center><div class="panel-heading">
            <h4><b>Transaksi Baru</b></h4>
        </div></center>
        <div class="panel-body">

            <div class="col-md-8 col-md-offset-2">
                <a href="transaksi.php" class="btn btn-sm btn-info pull-right">
                Kembali</a>
                <br/>
                <br/>
                <form method="post" action="transaksi_aksi.php">
                    <div class="form-group">
                        <label>Pelanggan</label>
                        <select class="form-control" name="nama" required="
                        required">
                            <option value="">- Pilih Pelanggan</option>

                            <?php
                            $data = mysqli_query($koneksi,"select * from user");
                            while($d=mysqli_fetch_array($data)){
                                ?>
                                <option value="<?php echo $d['id']; ?>"
                                ><?php echo $d['nama']; ?></option>

                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Bunga Per Ikat</label>
                        <input type="number" class="form-control" name="jumlah"
                        placeholder="Masukkan jumlah bunga .." required="required">
                    </div>

                    <div class="form-group">
                        <label>Tanggal Selesai</label>
                        <input type="date" class="form-control" name="transaksi_tgl"
                        required="required">
                    </div>
                    <br/>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Bunga</th>
                            <th width="20%">Jumlah</th>
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
                        <tr>
                            <td><input type="text" class="form-control" name="bunga[]"></td>
                            <td><input type="number" class="form-control" name="bunga_jumlah[]"></td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="bunga[]"></td>
                            <td><input type="number" class="form-control" name="bunga_jumlah[]"></td>
                        </tr>
                    </table>

                    <input type="submit" class="button" value="Simpan">

                </form>

            </div>

        </div>
    </div>
</div>

</body>
</html>