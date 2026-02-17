<?php
    $koneksi = mysqli_connect("localhost","root","","db_laundry");

    if(mysqli_connect_errno()){
        echo "Koneksi gagal :" . mysql_connect_error();
    }
?>