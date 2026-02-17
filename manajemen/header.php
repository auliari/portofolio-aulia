<?php
session_start();
include "../koneksi.php"; 

$username = $_SESSION['user_nama'];
$query = "SELECT user_nama, user_foto FROM user WHERE user_nama = '$username'";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glamour Essence</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php
        if($_SESSION['status']!="login"){
            header("location:../index.php?pesan=belum_login");
        }
    ?>
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
                </li>
            </ul>
            
            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-flex align-items-center mr-3">
            <img src="uploads/<?php echo $user['user_foto']; ?>" alt="User Image" class="img-circle elevation-2" style="width:30px; height:30px; object-fit:cover; margin-right:8px;">
            <span class="text-white font-weight-bold">
                <?php echo $user['user_nama']; ?> - manajemen
            </span>
        </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="fas fa-sign-out"> LOGOUT</i></a>
                </li>
            </ul>
        </nav>
        
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link text-center">
                <span class="brand-text font-weight-light">InventarisApp</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="uploads/<?php echo $user['user_foto']; ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block text-white"><?php echo $user['user_nama']; ?></a>
                        <span class="text-success">● Online</span>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
                        <li class="nav-item"><a href="index.php" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li class="nav-item"><a href="data_barang.php" class="nav-link"><i class="fas fa-box"></i> Data Barang</a></li>
                        <li class="nav-item"><a href="data_suplier.php" class="nav-link"><i class="fas fa-truck"></i> Data Supplier</a></li>
                        <li class="nav-item"><a href="peminjaman.php" class="nav-link"><i class="fas fa-hand-holding"></i> Peminjaman</a></li>
                        <li class="nav-item"><a href="barang_masuk.php" class="nav-link"><i class="fas fa-sign-in-alt"></i> Barang Masuk</a></li>
                        <li class="nav-item"><a href="barang_keluar.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Barang Keluar</a></li>
                        <li class="nav-item"><a href="daftar_pengguna.php" class="nav-link"><i class="fas fa-users"></i><p> Daftar Pengguna</p></a></li>
                        <li class="nav-item"><a href="laporan.php" class="nav-link"><i class="fas fa-file-alt"></i> Laporan</a></li>
                        <li class="nav-item"><a href="logout.php" class="nav-link"><i class="fas fa-sign-out"></i> Logout</a></li>
                    </ul>
                </nav>
            </div>
        </aside>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>