<?php
    $koneksi = mysqli_connect("localhost","root","","db_inventaris_aulia");

    if(mysqli_connect_errno()){
        echo "Koneksi gagal :" . mysql_connect_error();
    }
?>