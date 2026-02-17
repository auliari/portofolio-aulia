<?php
    include 'koneksi.php';
    include 'header.php';

    session_start();

    if(isset($_POST['add_product'])){

        $bunga = mysqli_real_escape_string($koneksi, $_POST['bunga']);
        $detail = mysqli_real_escape_string($koneksi, $_POST['detail']);
        $image = $_FILES['gambar']['name'];
        $image_size = $_FILES['gambar']['size'];
        $image_tmp_name = $_FILES['gambar']['tmp_name'];
        $image_folter = 'uploaded_img/'.$image;

        $select_product_name = mysqli_query($koneksi, "SELECT bunga FROM `produk` WHERE bunga = '$bunga'") or die('query failed');

        if(mysqli_num_rows($select_product_name) > 0){
            $message = 'nama produk sudah ada!';
        }else{
            $insert_product = mysqli_query($koneksi, "INSERT INTO `produk` (bunga, detail, gambar) VALUES('$bunga', '$detail', '$image')") or die('query failed');

            if($insert_product){
                if($image_size > 2000000){
                    $message[] = 'ukuran foto terlalu besar!';
                } else{
                    move_uploaded_file($image_tmp_name, $image_folter);
                    $message[] = 'gambar berhasil di upload!';
                }
            }
        }
    } 
    ?>

<section class="add-products">

        <form action="" method="POST" enctype="multipart/form-data">
            <h3><b>Tambah Produk Baru</b></h3>
            <input type="text" class="box" required placeholder="Masukkan nama produk" name="bunga">
            <textarea name="detail" class="box" required placeholder="Masukkan detail produk" cols="30" rows="10"></textarea>
            <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="gambar">
            <input type="submit" value="Tambah Produk" name="add_product" class="button"><a href="admin_products.php">
            <a href="admin_products.php" class="option-button">Kembali</a>
        </form>

    </section>