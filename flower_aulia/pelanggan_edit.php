<?php
    include 'koneksi.php';
    include 'header.php';

    session_start();

        $id = $_GET['id']; 

        $result = mysqli_query($koneksi, "SELECT * FROM `user` WHERE id = '$id'");
        $user = mysqli_fetch_assoc($result) ?? die("Data tidak ditemukan!");
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'];
            $email = $_POST['email'];
            $no_hp = $_POST['no_hp'];
            $alamat = $_POST['alamat'];
            $user_type = $_POST['user_type'];
            $query = "UPDATE user SET nama = '$nama', email = '$email', no_hp = '$no_hp', alamat = '$alamat', user_type = '$user_type' WHERE id = '$id'";
    
            if (mysqli_query($koneksi, $query)) {
                echo "<script>alert('Data berhasil diedit.');window.location='pelanggan.php';</script>";
                exit;
            } else {
                die("Error: " . mysqli_error($koneksi));
            }
        }
    ?>

<section class="add-products">

        <form action="" method="POST" enctype="multipart/form-data">
            <h3><b>edit users</b></h3>
            <input type="text" class="box" required placeholder="enter name" name="nama" value="<?php echo htmlspecialchars($user['nama']); ?>">
            <input type="email" class="box" required placeholder="enter email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
            <input type="number" min="0" class="box" required placeholder="enter number" name="no_hp" value="<?php echo htmlspecialchars($user['no_hp']); ?>">
            <textarea type="text" name="alamat" class="box" required placeholder="enter address" cols="30" rows="10"> <?php echo htmlspecialchars($user['alamat']); ?></textarea>
            <input type="text" class="box" required placeholder="enter user type" name="user_type" value="<?php echo htmlspecialchars($user['user_type']); ?>">
            <input type="submit" value="edit user" name="edit_user" class="button"><a href="pelanggan.php">
            <a href="pelanggan.php" class="option-button">go back</a>
        </form>

    </section>