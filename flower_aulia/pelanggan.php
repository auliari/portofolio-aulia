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
<div class="container" style="margin-left: 167px; width: 1180px;">
    <div class="panel">
        <div class="panel-heading">
            <h4 class="title"><b>Data <span>User</span></b></h4>
        <div>
        <div class="panel-body">
        <a href="pelanggan_tambah.php" class="button">Tambah</a>
            <br><br>
            <table class="table table-bordered table-striped">
                <tr style="background-color: rgba(255, 51, 153,.05); color: var(--pink);">
                    <th width="1%">Id</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>User type</th>
                    <th width="15%">OPSI</th>
                </tr>
                <?php
                    $data = mysqli_query($koneksi, "SELECT * FROM user");
                    $no = 1;
                    while ($d= mysqli_fetch_array($data)) {
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $d['nama'] ?></td>
                    <td><?php echo $d['email'] ?></td>
                    <td><?php echo $d['no_hp'] ?></td>
                    <td><?php echo $d['alamat'] ?></td>
                    <td><?php echo $d['user_type'] ?></td>
                    <td>
                        <a href="pelanggan_edit.php?id=<?php echo $d['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                        <a href="pelanggan_hapus.php?id=<?php echo $d['id']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                    </td>
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
                <?php include 'footer.php';?>
                </body>
</html>