<?php
    include 'koneksi.php';
    include 'header.php';

    session_start();

    if(isset($_POST['add_user'])){

        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $email = mysqli_real_escape_string($koneksi, $_POST['email']);
        $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
        $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
        $user_type = mysqli_real_escape_string($koneksi, $_POST['user_type']);

        $select_user = mysqli_query($koneksi, "SELECT nama FROM `user` WHERE nama = '$nama'") or die('query failed');

        if(mysqli_num_rows($select_user) > 0){
            $message = 'nama pelanngan sudah ada!';
        }else{
            $insert_product = mysqli_query($koneksi, "INSERT INTO `user` (nama, email, no_hp, alamat, user_type) VALUES('$nama', '$email', '$no_hp', '$alamat', '$user_type')") or die('query failed');
            }
        }
    ?>

<section class="add-products">

        <form action="" method="POST" enctype="multipart/form-data">
            <h3><b>Tambahkan User</b></h3>
            <input type="text" class="box" required placeholder="Masukkan nama" name="nama">
            <input type="email" class="box" required placeholder="Masukkan email" name="email">
            <input type="number" min="0" class="box" required placeholder="Masukkan no hp" name="no_hp">
            <textarea name="alamat" class="box" required placeholder="Masukkan alamat" cols="30" rows="10"></textarea>
            <input type="text" class="box" required placeholder="Masukkan user type" name="user_type">
            <input type="submit" value="add user" name="add_user" class="button"><a href="pelanggan.php">
            <a href="pelanggan.php" class="option-button">go back</a>
        </form>

    </section>