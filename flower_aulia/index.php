<?php
session_start();

include 'koneksi.php';

if (isset($_POST['nama']) && isset($_POST['password'])) {
$nama = $_POST['nama'];
$password = MD5($_POST['password']);

$data = mysqli_query($koneksi, "SELECT * FROM user WHERE nama='$nama' AND password='$password'");

if ($row = mysqli_num_rows($data) > 0) {
    $_SESSION['nama'] = $nama;
    $_SESSION['password'] = $password;
    header("location:admin_page.php");
} else {
 $message[] = 'Nama atau password salah!';
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleur d'Amour</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body style= "background-image: url('bunga.jpg');">

<section class="form-container">
   <?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
   ?>
      <form action="" method="POST">
         <h3>login now</h3>
         <input type="text" name="nama" class="box" placeholder="Masukkan nama" required>
         <input type="password" name="password" class="box" placeholder="Masukkan password" required>
         <input type="submit" class="button" name="submit" value="login now">
      </form>

   </section>
</body>
</html>