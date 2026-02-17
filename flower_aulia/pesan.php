<?php

@include 'koneksi.php';

session_start();

// Menghapus data berdasarkan ID
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($koneksi, "DELETE FROM `pesan` WHERE id = '$delete_id'") or die('Query failed');
    header('location:pesan.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Fleur d'Amour</title>

   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS -->
   <style>
      :root {
          --pink: #e84393;
          --gray: #999;
          --white: #fff;
          --shadow: rgba(255, 51, 153, .05);
      }

      body {
          font-family: Arial, sans-serif;
          margin: 0;
          padding: 0;
          background-color: #f9f9f9;
      }

      section {
          padding: 2rem 9%;
      }

      .review .heading {
         text-align: center;
         margin-bottom: 2rem;
         color:var(--black);
         text-transform: uppercase;
         font-family: Verdana, Geneva, Tahoma, sans-serif;
         font-size: 3.5rem;
      }

      .review .heading span {
          color: var(--pink);
      }

      .review .box-container {
          display: flex;
          flex-wrap: wrap;
          gap: 1.5rem;
          justify-content: center;
          margin-left: 162px;
          width: 1170px;
      }

      .review .box {
         flex: 1 1 calc(50% - 1.5rem); /* Membagi lebar menjadi dua */
         max-width: calc(50% - 1.5rem);
          background-color: var(--white);
          border-radius: .5rem;
          padding: 2rem;
          box-shadow: 0 .5rem 1.5rem var(--shadow);
          position: relative;
          text-align: left;
      }

      .review .box .stars i {
          color: #e84393;
          font-size: 1.5rem;
          margin: 0 .2rem;
      }

      .review .box p {
          font-size:1.7rem;
          color: var(--gray);
          margin: 1.5rem 0;
          line-height: 1.5;
      }

      .review .box .user {
          display: flex;
          align-items: center;
          justify-content: left;
          margin-top: 1.5rem;
      }

      .review .box .user img {
          height: 6rem;
          width: 6rem;
          border-radius: 50%;
          object-fit: cover;
          margin-right: 1rem;
      }

      .review .box .user h3 {
          font-size: 1.5rem;
          color: #333;
          margin: 0;
      }

      .review .box .user span {
          font-size: 1.2rem;
          color: var(--gray);
      }

      .delete-button {
         position: absolute;
          bottom: 2rem;
          right: 1.5rem;
          display: inline-block;
          margin-top: 1rem;
          padding: .5rem 1rem;
          background-color: #d9534f;
          color: var(--white);
          border-radius: .3rem;
          text-decoration: none;
      }

      .delete-button:hover {
          background-color: #c9302c;
      }
   </style>
</head>
<body>

<?php @include 'header.php'; ?>

<section class="review" id="review">
    <h1 class="heading"><b>Customer's <span>Review</b></span></h1>

    <div class="box-container">
        <?php
        $select_message = mysqli_query($koneksi, "SELECT * FROM `pesan`") or die('Query failed');
        if (mysqli_num_rows($select_message) > 0) {
            while ($fetch_message = mysqli_fetch_assoc($select_message)) {
        ?>
        <div class="box">
            <!-- Tampilkan rating -->
            <div class="stars">
                <?php
                $rating = $fetch_message['rating'];
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $rating) {
                        echo '<i class="fas fa-star"></i>'; // Bintang Penuh
                    } else {
                        echo '<i class="far fa-star"></i>'; // Bintang Kosong
                    }
                }
                ?>
            </div>
            <!-- Tampilkan pesan -->
            <p><?php echo $fetch_message['pesan']; ?></p>
            <!-- Tampilkan data user -->
            <div class="user">
                <img src="<?php echo $fetch_message['foto']; ?>" alt="<?php echo $fetch_message['nama']; ?>">
                <div class="user-info">
                    <h3><b><?php echo $fetch_message['nama']; ?></b></h3>
                    <span><?php echo $fetch_message['email']; ?></span>
                </div>
            </div>
            <!-- Tombol hapus -->
            <a href="pesan.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('Delete this message?');" class="delete-button">Delete</a>
        </div>
        <?php
            }
        } else {
            echo '<p class="empty">You have no messages!</p>';
        }
        ?>
    </div>
</section>
<br><br><br>
<?php include 'footer.php';?>
</body>
</html>
