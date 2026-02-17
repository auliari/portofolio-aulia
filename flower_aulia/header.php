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
    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/4592f70558.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Tambahan styling untuk memastikan dropdown inline */
        .my-header-flex-navbar {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .dropdown-menu {
            min-width: 200px;
            text-align: left;
        }
        .dropdown a {
            color: var(--light-color); /* Warna teks dropdown */
            text-decoration: none;
        }
        .dropdown:hover > .dropdown-menu {
            display: block;
        }
    </style>
</head>
<body>
<header class="my-header">

<div class="my-header-flex">

   <a href="#" class="my-header-flex-logo"><b>Fleur <span>d'Amour</b></span></a>

   <nav class="my-header-flex-navbar">
      <a href="admin_page.php"><i class="fa-solid fa-house"></i> Dashboard</a>
      <a href="admin_products.php"><i class="fa-solid fa-spa"></i> Produk</a>
      <a href="transaksi.php"><i class="fa-solid fa-random"></i> Transaksi</a>
      <a href="pelanggan.php"><i class="fa-solid fa-user"></i> User</a>
      <a href="pesan.php"><i class="fa-solid fa-comment"></i> Ulasan</a>
      <div class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-gear"></i></i> Pengaturan<span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="harga.php"><i class="fa-solid fa-usd"></i> Pengaturan Harga</a></li>
                <li><a href="ganti_password.php"><i class="fa-solid fa-lock"></i> Ganti Password</a></li>
            </ul>
</div>
      <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
   </nav>

</div>

</header> 
</body>
</html>