<?php
    session_start();

    include 'koneksi.php';

    $user_nama = $_POST['user_nama'];
    $user_password = MD5($_POST['user_password']);

    $data = mysqli_query($koneksi,"select * from user where user_nama='$user_nama' and user_password='$user_password'");


    $cek = mysqli_num_rows($data);

    if($cek > 0){

        $row = mysqli_fetch_array($data);
        $_SESSION['user_nama'] =  $user_nama;
        $_SESSION['status'] = "login";
        $_SESSION['user_level'] = $row['user_level'];
        header("location:admin/index.php");

        if($_SESSION['user_level'] == 1){
            header("location:admin/index.php");

        }else if ($_SESSION['user_level'] == 2){
            header("location:manajemen/index.php");
        }
        }else{
        header("location:index.php?pesan=gagal");}

    
?>