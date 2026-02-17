<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Laundry</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <script type="text/javascript" src="../assets/js/jquery.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.js"></script>
 
</head>
<body style="background: #EBF4F6">
    <?php
        session_start();
        if($_SESSION['status']!="login"){
            header("location:../index.php?pesan=belum_login");
        }
    ?>

    <nav style="background-color:rgb(255, 255, 255);" style="border-radius:0px">
        <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
            </button>
            <a class="navbar-brand" href="index.php" style="color:#921A40;">Laundry</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php" style="color:#921A40;"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                <li><a href="pelanggan.php" style="color:#921A40;"><i class="glyphicon glyphicon-user"></i> Pelanggan</a></li>
                <li><a href="transaksi.php" style="color:#921A40;"><i class="glyphicon glyphicon-random"></i> Transaksi</a></li>
                <li><a href="laporan.php" style="color:#921A40;"><i class="glyphicon glyphicon-list-alt"></i> Laporan</a></li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                    aria-haspopup="true" aria-expanded="false" style="color:#921A40;"><i class="glyphicon glyphicon-wrench"></i> Pengaturan<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <li><a href="harga.php" style="color:#921A40;"><i class="glyphicon glyphicon-usd"></i> Pengaturan Harga</a></li>
                    <li><a href="ganti_password.php" style="color:#921A40;"><i class="glyphicon glyphicon-lock"></i> Ganti Password</a></li>
            </ul>
    </li>
                 <li><a href="logout.php" style="color:#921A40;"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><p class="navbar-text" style="color:#C75B7A;">Halo, <b style="color:#921A40;"><?php
                echo $_SESSION['username']; ?></b> !</p></li>
                </ul>
        </div>
        </div>
    </nav>

<br>
</body>
</html>