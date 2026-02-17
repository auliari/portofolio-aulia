<?php
    include 'koneksi.php';
    include 'header.php';

    if (isset($_GET['delete'])) {
      $delete_id = $_GET['delete']; // Ambil ID dari URL
      $delete_query = "DELETE FROM `produk` WHERE id = '$delete_id'"; // Query SQL
      $run_delete = mysqli_query($koneksi, $delete_query); // Eksekusi query
  
      // Cek apakah query berhasil dijalankan
      if ($run_delete) {
          echo "<script>
                  alert('Produk berhasil dihapus');
                  window.location.href = 'admin_products.php'; // Refresh halaman setelah hapus
                </script>";
      } 
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleur d'Amour</title>
    
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
</head>
<body style="background: var(--light-bg);">

<h1 class="title"><b>data <span>produk</span></b></h1>
    <a href="tambah_produk.php" class="button" style="position: absolute; right: 300px;">Tambah Produk</a>
            <br><br>

    <section class="show-products">

   <div class="box-container">

      <?php
         $select_products = mysqli_query($koneksi, "SELECT * FROM `produk`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         <br><br>
         <img class="image" src="uploaded_img/<?php echo $fetch_products['gambar']; ?>" alt="">
         <b><div class="name"><?php echo $fetch_products['bunga']; ?></div></b>
         <div class="details"><?php echo $fetch_products['detail']; ?></div>
         <a href="admin_update_product.php?update=<?php echo $fetch_products['id']; ?>" class="option-button">update</a>
         <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-button" onclick="return confirm('delete this product?');">delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>
   

</section>
    </div>
    </div>
    </div>
<?php include 'footer.php';?>
</body>
</html>